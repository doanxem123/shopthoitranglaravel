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
		$sales = DB::table('tbl_sales')->where('sales_status','1')->orderby('sales_id','desc')->get();
		$invoice ='';
		if(Session::get('account')){
			if(Session::get('account')->permission_id==1){
				$invoice = DB::table('tbl_invoice')->orderby('created_at','desc');
			}
			else{
				$invoice = DB::table('tbl_invoice')->where('account_id',Session::get('account')->account_id)->orderby('created_at','desc');
			}
			$invoice=$invoice->paginate(10);
		}

		

		//$invoice = DB::table('tbl_invoice')->join('tbl_details_invoice','tbl_invoice.invoice_id','=','tbl_details_invoice.invoice_id')->get();

		return view('pages.invoice.invoice',['invoice' => $invoice])->with('category',$category_product)->with('brand',$brand_product)->with('sales',$sales);
	}

	public function details_invoice($invoice_id){
		$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
		$sales = DB::table('tbl_sales')->where('sales_status','1')->orderby('sales_id','desc')->get();
		//$details_invoice = DB::table('tbl_details_invoice')->join('tbl_details_product','tbl_details_invoice.details_product_id','=','tbl_details_product.details_product_id')->join('tbl_product','tbl_details_product.product_id','=','tbl_product.product_id')->join('tbl_size_product','tbl_details_product.size_id','=','tbl_size_product.size_id') ->where('tbl_details_invoice.invoice_id',$invoice_id)->orderby('tbl_details_product.details_product_id','desc')->get();

		$details_invoice = DB::table('tbl_details_invoice')
		->select('tbl_details_invoice.details_product_id','tbl_product.product_id','images_id','product_name','size_name','details_invoice_quantity','product_price','details_invoice_price','sales_rate','images_URL',DB::raw("COUNT('details_product_id') AS product_count"))->join('tbl_details_product','tbl_details_invoice.details_product_id','=','tbl_details_product.details_product_id')->join('tbl_product','tbl_details_product.product_id','=','tbl_product.product_id')->join('tbl_images_product', 'tbl_product.product_id', '=', 'tbl_images_product.product_id')->join('tbl_size_product','tbl_details_product.size_id','=','tbl_size_product.size_id')->join('tbl_sales','tbl_product.sales_id','=','tbl_sales.sales_id')->where('tbl_details_invoice.invoice_id',$invoice_id)->orderBy('product_count', 'desc')->groupBy('tbl_details_invoice.details_product_id')->get();
		$invoice = DB::table('tbl_invoice')->join('tbl_discount','tbl_invoice.discount_id','=','tbl_discount.discount_id')->where('invoice_id',$invoice_id)->get();
		
		$invoice_permission = DB::table('tbl_permission')->where('permission_id',$invoice->first()->invoice_permission_id)->get();
		
		return view('pages.invoice.details_invoice')->with('category',$category_product)->with('brand',$brand_product)->with('invoice',$invoice)->with('details_invoice',$details_invoice)->with('invoice_permission',$invoice_permission)->with('sales',$sales);
	}

	public function filter_invoice(Request $request){

		$category_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
		$brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
		$sales = DB::table('tbl_sales')->where('sales_status','1')->orderby('sales_id','desc')->get();

		$invoice_id = $request->searchid;
		$invoice_account_name = $request->searchname;
		$invoice_account_phone = $request->getsearchphone;
		$invoice_account_email = $request->getsearchemail;
		$invoice_account_address = $request->searchaddress;
		$invoice_total = $request->searchtotal;
		$created_at = $request->searchtime;
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
		$invoice = $invoice->orderby('created_at','desc')->paginate(10);

		return view('pages.invoice.invoice',['invoice' => $invoice])->with('category',$category_product)->with('brand',$brand_product)->with('invoice',$invoice)->with('sales',$sales);
		
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

	//Chạy update qua checkbox
	public function update_invoice_checkbox($invoice_id,$send_status,$invoice_desc){
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

		$txt = '['.Carbon::now().'] : '.$status.' : '.$invoice_desc;

		$data_update['invoice_desc']=$invoice->invoice_desc."\r".$txt;
		$data_update['updated_at']=Carbon::now();
		DB::table('tbl_invoice')->where('invoice_id',$invoice_id)->update($data_update);
	}

	public function checkbox_ajax(Request $request){

		$list_id = explode(',', $request->get('list_id',''));
		$invoice_desc='';
		if($request->invoice_desc!=null){
			$invoice_desc = $request->get('invoice_desc','');
		}
		$code = $request->get('code','');
		$ThongBao='';

		if(Session::get('account') && Session::get('account')->permission_id == 1){
			if($code == 1){
				for($i = 0; $i < count($list_id); $i++){
					$invoice = DB::table('tbl_invoice')->where('invoice_id',$list_id[$i])->first();
					if($invoice->invoice_status==0){
						$this->update_invoice_checkbox($list_id[$i],1,$invoice_desc);
					}
					else if($invoice->invoice_status==2){
						$this->update_invoice_checkbox($list_id[$i],3,$invoice_desc);
					}
					else{
						if($invoice->invoice_status==1){
							$status = 'Đã hoàn thành';
						}
						if($invoice->invoice_status==3){
							$status = 'Đã huỷ';
						}
						$ThongBao .= "Mã ".$list_id[$i]." không thực hiện hành động được vì đang ở trạng thái ".$status."\n";
					}
				}
			}
			if($code == 2){
				for($i = 0; $i < count($list_id); $i++){
					$invoice = DB::table('tbl_invoice')->where('invoice_id',$list_id[$i])->first();
					if($invoice->invoice_status==0){
						$this->update_invoice_checkbox($list_id[$i],3,$invoice_desc);
					}
					else if($invoice->invoice_status==2){
						$this->update_invoice_checkbox($list_id[$i],0,$invoice_desc);
					}
					else{
						if($invoice->invoice_status==1){
							$status = 'Đã hoàn thành';
						}
						if($invoice->invoice_status==3){
							$status = 'Đã huỷ';
						}
						$ThongBao .= "Mã ".$list_id[$i]." không thực hiện hành động được vì đang ở trạng thái ".$status."\n";
					}
				}
			}
			if($code == 3){
				for($i = 0; $i < count($list_id); $i++){
					$invoice = DB::table('tbl_invoice')->where('invoice_id',$list_id[$i])->delete();
					$ThongBao .= "Mã ".$list_id[$i]." đã xoá thành công \n";
				}
			}
		}
		return $ThongBao;
	}

}
