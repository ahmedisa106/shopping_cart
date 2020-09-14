<?php

namespace Modules\ConfigModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\ConfigModule\Entities\Config;
use Modules\ConfigModule\Entities\ConfigCategory;

class ConfigsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function showConfig($id)
    {

        $cat = ConfigCategory::with('configs')->find($id);


        return view('configmodule::configs.showConfig', compact('cat'));

    }

    public function update(Request $request)
    {


        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $val) {

            if (!is_array($val)) {
                $config = Config::where('var', $key)->update(["static_value" => $val]);
            } else {
                foreach ($val as $index => $value) {
                    $config = DB::table('configs')
                        ->select('*')
                        ->join('config_translations', 'config_translations.config_id', '=', 'configs.id')
                        ->where('locale', $key)
                        ->where('var', $index)
                        ->update(['value' => $value]);
                }
            }


        }

        return redirect()->back()->with('update', 'data updated successfully');

    }


}
