<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
use Carbon\Carbon;

session_start();
/*Status :
0=Chờ xác nhận
1=Đã hoàn thành
2=Chờ huỷ
3=Đã huỷ
*/
class InvoiceController extends Controller
{
	public function invoice(){
		$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();

		// if(Session::get('account')){
		// 	if(Session::get('account')->permission_id==1){
		// 		$invoice = DB::table('tbl_invoice')->orderby('created_at','desc');
		// 	}
		// 	else{
		// 		$invoice = DB::table('tbl_invoice')->where('account_id',Session::get('account')->account_id)->orderby('created_at','desc');
		// 	}
			
		// }
		// else{
		// 	$invoice = DB::table('tbl_invoice')->where('account_id',2)->orderby('created_at','desc');
		// }

		// $invoice=$invoice->paginate(10);

		// $invoice = DB::table('tbl_invoice')->join('tbl_details_invoice','tbl_invoice.invoice_id','=','tbl_details_invoice.invoice_id')->get();

		return view('pages.invoice.invoice')->with('category',$category_product)->with('brand',$brand_product);
	}

	public function details_invoice($invoice_id){
		$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
		//$details_invoice = DB::table('tbl_details_invoice')->join('tbl_details_product','tbl_details_invoice.details_product_id','=','tbl_details_product.details_product_id')->join('tbl_product','tbl_details_product.product_id','=','tbl_product.product_id')->join('tbl_size_product','tbl_details_product.size_id','=','tbl_size_product.size_id') ->where('tbl_details_invoice.invoice_id',$invoice_id)->orderby('tbl_details_product.details_product_id','desc')->get();

		$details_invoice = DB::table('tbl_details_invoice')
		->select('tbl_product.product_id','images_id','product_name','size_name','details_invoice_quantity','product_price','details_invoice_price','images_URL',DB::raw("COUNT('product_id') AS product_count"))->join('tbl_details_product','tbl_details_invoice.details_product_id','=','tbl_details_product.details_product_id')->join('tbl_product','tbl_details_product.product_id','=','tbl_product.product_id')->join('tbl_images_product', 'tbl_product.product_id', '=', 'tbl_images_product.product_id')->join('tbl_size_product','tbl_details_product.size_id','=','tbl_size_product.size_id')->where('tbl_details_invoice.invoice_id',$invoice_id)->orderBy('product_count', 'desc')->groupBy('tbl_product.product_id')->get();

		$invoice = DB::table('tbl_invoice')->join('tbl_discount','tbl_invoice.discount_id','=','tbl_discount.discount_id')->where('invoice_id',$invoice_id)->get();
		
		$invoice_permission = DB::table('tbl_permission')->where('permission_id',$invoice->first()->invoice_permission_id)->get();
		

		//$invoice = DB::table('tbl_invoice')->where('invoice_id',$invoice_id)->first();

		//->join('tbl_product','tbl_details_product.product_id','=','tbl_product.product_id')->join('tbl_size_product','tbl_details_product.size_id','=','tbl_size_product.size_id') 
		return view('pages.invoice.details_invoice')->with('category',$category_product)->with('brand',$brand_product)->with('invoice',$invoice)->with('details_invoice',$details_invoice)->with('invoice_permission',$invoice_permission);
	}

	public function filter_invoice(Request $request){
		if($request->ajax()){
			$output = '';
			$invoice_id = $request->get('searchid','');
			$invoice_account_name = $request->get('searchname','');
			$invoice_account_phone = $request->get('searchphone','');
			$invoice_account_email = $request->get('searchemail','');
			$invoice_account_address = $request->get('searchaddress','');
			$invoice_total = $request->get('searchtotal','');
			$created_at = $request->get('searchtime','');

			if(Session::get('account')){
				if(Session::get('account')->permission_id==1){
					$invoice = DB::table('tbl_invoice');
				}
				else{
					$invoice = DB::table('tbl_invoice')->where('account_id',Session::get('account')->account_id);
				}
			}
			else{
				$invoice = DB::table('tbl_invoice')->where('account_id',2)->where('invoice_id',$invoice_id);
			}
			if($invoice_id != '' && $invoice_id != null){
				$invoice=$invoice->where('invoice_id',$invoice_id);
			}
			if($invoice_account_name != '' && $invoice_account_name != null){
				$invoice=$invoice->where('invoice_account_name','like','%'.$invoice_account_name.'%');
			}

			if($invoice_account_phone != '' && $invoice_account_phone != null){
				$invoice=$invoice->where('invoice_account_phone','like','%'.$invoice_account_phone.'%');
			}
			if($invoice_account_email != '' && $invoice_account_email != null){
				$invoice=$invoice->where('invoice_account_email','like','%'.$invoice_account_email.'%');
			}
			if($invoice_account_address != '' && $invoice_account_address != null){
				$invoice=$invoice->where('invoice_account_address','like','%'.$invoice_account_address.'%');
			}
			if($invoice_total != '' && $invoice_total != null){
				$invoice=$invoice->where('invoice_total',$invoice_total);
			}
			if($created_at != '' && $created_at != null){
				$invoice=$invoice->where('created_at','like','%'.$created_at.'%');
			}
			$invoice = $invoice->orderby('created_at','desc')->get();
			if ($invoice) {
				$dem=1;
				$show='';

				foreach ($invoice as $key => $item) {
					if(Session::get('account') && Session::get('account')->permission_id==1){
						if($item->invoice_status==0){
							$show='
							<td style="background-color: lightblue">
							<p>Chờ xác nhận</p>
							<a href="'.url("/update-invoice/id={$item->invoice_id}&status=1").'" value="1">Hoàn thành</a>
							</td>';
						}
						elseif($item->invoice_status==1){
							$show='
							<td style="background-color: lightgreen">
							<p>Đã hoàn thành</p>
							</td>';
						}
						elseif($item->invoice_status==2){
							$show='
							<td style="background-color: yellow">
							<p>Chờ huỷ</p>
							<a href="'.url("/update-invoice/id={$item->invoice_id}&status=3").'" value="3">Đồng ý</a>
							</td>';
						}
						elseif($item->invoice_status==3){
							$show='
							<td style="background-color: red">
							<p>Đã huỷ</p>
							</td>';
						}
					}
					else{
						if($item->invoice_status==0){
							$show='
							<td style="background-color: lightblue">
							<p>Chờ xác nhận</p>
							<a href="'.url("/update-invoice/id={$item->invoice_id}&status=2").'" value="1">Huỷ đơn hàng</a>
							</td>';
						}
						elseif($item->invoice_status==1){
							$show='
							<td style="background-color: lightgreen">
							<p>Đã hoàn thành</p>
							</td>';
						}
						elseif($item->invoice_status==2){
							$show='
							<td style="background-color: yellow">
							<p>Chờ huỷ</p>
							</td>';
						}
						elseif($item->invoice_status==3){
							$show='
							<td style="background-color: red">
							<p>Đã huỷ</p>
							</td>';
						}
					}
					
					$output .= '<tr class="search-table">
					<th scope="row">'.$dem++.'</th>
					<td class="search-id"><a href='.url("/details-invoice/id={$item->invoice_id}").'>'.$item->invoice_id.'</a></td>
					<td class="search-name" >'.$item->invoice_account_name.'</td>
					<td class="search-phone">'.$item->invoice_account_phone.'</td>
					<td class="search-email">'.$item->invoice_account_email.'</td>
					<td class="search-address">'.$item->invoice_account_address.'</td>
					<td class="search-total">'.$item->invoice_total.'</td>
					<td class="search-time">'.$item->created_at.'</td>
					'.$show.'
					</tr>';
				}
			}
			return Response($output);
		//return response()->json(['value' => 'some data']);
		}
	}

	public function update_invoice($invoice_id,$send_status,Request $request){
		$invoice = DB::table('tbl_invoice')->where('invoice_id',$invoice_id)->first();
		$data_update = array();

		$data_update['invoice_status'] = $send_status;

		$status='';
		if($send_status==0){
			$status = 'Chờ xác nhận';
		}
		if($send_status==1){
			$status = 'Đã hoàn thành';
		}
		if($send_status==2){
			$status = 'Chờ huỷ';
		}
		if($send_status==3){
			$status = 'Đã huỷ';
		}

		$txt = '['.Carbon::now().'] : '.$status;
		if($request){
			$txt = $txt.' : '.$request->invoice_desc;
		}
		$data_update['invoice_desc']=$invoice->invoice_desc."\r".$txt;
        $data_update['updated_at']=Carbon::now();
		DB::table('tbl_invoice')->where('invoice_id',$invoice_id)->update($data_update);

		return Redirect::to(url()->previous());
	}

}
