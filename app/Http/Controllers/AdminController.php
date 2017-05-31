<?php

namespace App\Http\Controllers;

use App\Clinic;
use App\DrugType;
use DB;
use Exception;
use Log;
use Mail;

class AdminController extends Controller {
    private $guard = "admin";


    /**
     * Handles the root url under Admin route group
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        if (\Auth::guard($this->guard)->check()) {
            $clinics = Clinic::where('accepted', false)->get();
            $acceptedClinics = Clinic::where('accepted', true)->get();
            return view("admin.acceptClinics", compact("clinics", "acceptedClinics"));
        }
        return view("admin.adminLogin");
    }

    /**
     * Accepts a clinic, Adds the basic quantity types to the clinic
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptClinic($id) {
        $clinic = Clinic::find($id);
        DB::beginTransaction();
        try {
            $clinic->accepted = true;
            $clinic->update();

            // When accepting a clinic, basic drug types are also added along with that.
            // They are then saved for the corresponding clinic.
            $quantityTypes = ['Pills', 'Litres', 'Tablets', 'Milli Litres', 'Bottles'];
            $types = array();
            $user = $clinic->users()->first();
            foreach ($quantityTypes as $quantityType) {
                $type = new DrugType();
                $type->drug_type = $quantityType;
                $type->created_by = $user->id;
                $types[] = $type;
            }
            $clinic->quantityTypes()->saveMany($types);

            Mail::send('auth.emails.clinicAccepted', ['clinic' => $clinic], function ($m) use ($clinic) {
                $m->to($clinic->email, $clinic->name)->subject('cmp247.com - 诊所申请通过');
            });
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Unable to accept clinic due to :" . $e->getMessage());
            return back()->with("error", "Unable to accept the clinic");
        }
        DB::commit();
        return back()->with("success", $clinic->name . " clinic Accepted");
    }


    /**
     * Remove a clinic which is to be accepted
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteClinic($id) {
        $clinic = Clinic::find($id);
        if ($clinic->accepted) {
            return back();
        }
        $clinic->users()->delete();
        $clinic->delete();
        return back()->with("success", $clinic->name . " clinic removed");
    }

}
