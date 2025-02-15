<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class CategoryController extends Controller
{
    private function check($request, $module, $response_type)
    {
        if ($request->user()->can($module)) {
            return true;
        } else {
            if ($response_type == 'view') {
                abort(404);
            }

            return false;
        }
    }

    public function index(Request $request)
    {
        $check = $this->check($request, 'view-categories', 'view');
        if ($check) {
            $page_name = 'Coupon categories';

            return view('Category.index', compact('page_name'));
        }
    }

    public function get_list(Request $request)
    {
        $check = $this->check($request, 'view-categories', 'ajax');
        if ($check) {
            if ($request->ajax()) {
                if ($request->title != '') {
                    $keyword = $_GET['title'];
                    $records = Categories::where('title', 'like', '%'.$keyword.'%')->paginate(15);
                } else {
                    $records = Categories::paginate(15);
                }
                $response['success'] = true;
                $response['html'] = view('Category.list', ['records' => $records])->render();
                $response['pagination'] = view('admin.pagination', ['page' => $records])->render();

                return response()->json($response);
                exit;
            }
        }
    }

    public function get_record_by_id(Request $request, $id)
    {
        $check = $this->check($request, 'edit-categories', 'ajax');
        if ($check) {
            $record = Categories::where(['id' => $id])->first();
            if (! empty($record)) {
                $response['success'] = true;
                $response['data'] = $record->toarray();
            } else {
                $response['success'] = false;
            }
        } else {
            $response['success'] = false;
            $response['message'] = "You don't have permission";
        }

        return response()->json($response);
        exit;
    }

    public function store(Request $request)
    {
        $check = $this->check($request, 'add-categories', 'ajax');
        if ($check) {
            if ($request->isMethod('post')) {
                $input = $request->all();
                $validation_array = [
                    'title' => 'required',
                ];
                $validator = Validator::make($request->all(), $validation_array);
                if (! $validator->fails()) {
                    try {
                        unset($input['confirmed']);
                        $input['owner_id'] = Auth::user()->id;
                        $user = Categories::create($input);
                        $response['success'] = true;
                        $response['message'] = 'Recored Store SuccessFully';
                        $response['resetForm'] = true;
                        $response['callBackFunction'] = 'addCallBack';
                    } catch (exception $e) {
                        $response['success'] = false;
                        $response['message'] = 'There is some error please try after some time';
                    }
                } else {
                    $response['success'] = false;
                    $html = "<ol type='1'>";
                    foreach ($validator->errors()->toarray() as $value) {
                        $html .= '<li>'.$value['0'].'</li>';
                    }
                    $html .= '</ol>';
                    $response['message'] = $html;
                }
            }
        } else {
            $response['success'] = false;
            $response['message'] = "You don't have permission";
        }

        return response()->json($response);
        exit;
    }

    public function update(Request $request)
    {
        $check = $this->check($request, 'edit-categories', 'ajax');
        if ($check) {
            if ($request->isMethod('post')) {
                $update = $request->all();
                $validation_array = [
                    'title' => 'required',
                ];
                $validator = Validator::make($request->all(), $validation_array);
                if (! $validator->fails()) {
                    unset($update['_token']);
                    $user = Categories::find($update['id'])->update($update);
                    $response['success'] = true;
                    $response['message'] = 'Records Updated SuccessFully';
                    $response['callBackFunction'] = 'updatedCallback';
                } else {
                    $response['success'] = false;
                    $html = "<ol type='1'>";
                    foreach ($validator->errors()->toarray() as $value) {
                        $html .= '<li>'.$value['0'].'</li>';
                    }
                    $html .= '</ol>';
                    $response['message'] = $html;
                }

                return response()->json($response);
                exit;
            }
        } else {
            $response['success'] = false;
            $response['message'] = "You don't have permission";
        }

        return response()->json($response);
        exit;
    }

    public function change_status(Request $request, $id, $status)
    {
        $check = $this->check($request, 'ai-categories', 'ajax');
        if ($check) {
            $update['status'] = $status;
            $user = Categories::find($id)->update($update);
            $response['success'] = true;
            $response['message'] = 'Status Changed SuccessFully';
        } else {
            $response['success'] = false;
            $response['message'] = "You don't have permission";
        }

        return response()->json($response);
        exit;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $check = $this->check($request, 'delete-categories', 'ajax');
        if ($check) {
            $affectedRows = Categories::find($id)->delete();
            if ($affectedRows) {
                //$this->unlink($record->image);
                $response['success'] = true;
            } else {
                $response['success'] = false;
            }
        } else {
            $response['success'] = false;
            $response['message'] = "You don't have permission";
        }

        return response()->json($response);
        exit;
    }

    public function unlink($image)
    {
        unlink($_SERVER['DOCUMENT_ROOT'].'/'.$this->destination_image_path.$image);
    }
}
