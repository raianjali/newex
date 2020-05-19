<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use App\Role;
use App\State;
use Illuminate\Http\Request;
use App\Http\Traits\JsonUtilTrait;
use Illuminate\Support\Facades\Validator;
use Log;
use Throwable;

class StaticDataController extends Controller
{
    use JsonUtilTrait;

    /**
     * Get Countreis function
     *
     * @return Json
     */
    public function index_country(Request $request)
    {
        try {
            $Country = Country::whereStatus(1)->when(request()->get('search'), function ($query) use ($request) {
                return $query->where('name', 'like', $request->get('search') . '%');
            })->get();

            return $this->responseWithSuccess("Data Found ", $Country, 200);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return $this->responseWithError('Internal server error', [], 500, 500);
        }
    }


    /**
     * Get States from country_id function
     *
     * @param country_id $country_id
     * @return Json
     */
    public function index_state(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "country_id" => "required|integer|exists:countries,country_id",
                "search" => "nullable|string",
            ]);

            if ($validator->fails()) {
                return $this->responseWithError("Validation Error", $validator->messages(), 400);
            }

            $state = State::where('status', 1)
                ->where('country_id', $request->get('country_id'))
                ->when(request()->get('search'), function ($query) use ($request) {
                    return $query->where('name', 'like', $request->get('search') . '%');
                })
                ->get();

            return $this->responseWithSuccess("Data Found ", $state, 200);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return $this->responseWithError('Internal server error', [], 500, 500);
        }
    }


    /**
     * Get Cities function
     *
     * @param state_id $state_id
     * @return Json
     */
    public function index_city(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "state_id" => "required|integer|exists:states,state_id",
                "search" => "nullable|string",
            ]);

            if ($validator->fails()) {
                return $this->responseWithError("Validation Error", $validator->messages(), 400);
            }

            $cities = City::where('status', 1)
                ->where('state_id', $request->get('state_id'))
                ->when(request()->get('search'), function ($query) use ($request) {
                    return $query->where('name', 'like', $request->get('search') . '%');
                })->get();

            return $this->responseWithSuccess("Data Found ", $cities, 200);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return $this->responseWithError('Internal server error', [], 500, 500);
        }
    }


    /**
     * Get Roles function,  except Super_admin role
     *
     * @return Json
     */
    public function index_roles(Request $request)
    {
        try {
            $roles = Role::where('status', 1)->where('role_id', '!=', 1)->get();
            return $this->responseWithSuccess("Data Found ", $roles, 200);
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            return $this->responseWithError('Internal server error', [], 500, 500);
        }
    }
}
