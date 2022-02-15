<?php
namespace App\Controllers\Admin;

use Illuminate\Database\Capsule\Manager as DB;
use stdClass;
use Interop\Container\ContainerInterface;
use App\Extensions\AdminBase;
use App\Extensions\Functions;
use App\Models\Marquees as MarqueesModel;

class Marquee extends AdminBase
{
	public function __Construct(ContainerInterface $container)
    {
		parent::__Construct($container);
	}

	public function listMarquee($request, $response)
    {
		$get = $request->getQueryParams();
		// return $response->withJson($get);
		$where = array();
		//$where[] = array('status',1);
		if(isset($get['select_status']) &&  $get['select_status'] != '-1' )
			$where[] = array('status',$get['select_status']);
		if(isset($get['select_marquee_target']) &&  $get['select_marquee_target'] != '-1' )
			$where[] = array('target',$get['select_marquee_target']);
		$start = 0;
		if(isset($get['start']))
			$start = intval($get['start']);
		
		$length = 0;
		if(isset($get['length']))
			$length = intval($get['length']);
		
		$marquees = MarqueesModel::select('target','sort','content','release_time_start','release_status','status','operator','updated_at','created_at','id')->where($where)->skip($start)->take($length)->get();
		
		$result = array();
		foreach($marquees as $marquee){
			if($marquee->target === 3)
				$marquee->target = _('所有');
			elseif($marquee->target === 1)
				$marquee->target =  _('会员');		
			elseif($marquee->target === 2)
				$marquee->target =  _('代理');
			else
				$marquee->target =  $marquee->target;
			
			$marquee->release_status='<a class="status-btn status-open" href="javascript:void(0);">'._('常駐').'</a>';
			if ($marquee->status == 1) {
				$marquee->status='<a class="status-btn status-open" href="javascript:void(0);">'._('啟用').'</a>';
			} else {
				$marquee->status='<a class="status-btn status-close" href="javascript:void(0);">'._('停用').'</a>';
			}
			$action = "<a href=\"marquee_editor?etype=edit&edit_marquee_id=".$marquee->id."\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>\n\t\t\t\t\t\t\t\t<a href=\"javascript:void(0);\" onclick=\"delete_item(".$marquee->id.");\" class=\"btn btn-xs default\"> <i class=\"fa fa-trash-o\"></i> 刪除 </a>";
		
			$formatItem = array();
			$formatItem[]=$marquee->target;
			$formatItem[]=$marquee->sort;
			$formatItem[]=$marquee->content;
			$formatItem[]=$marquee->release_time_start;
			$formatItem[]=$marquee->release_status;
			$formatItem[]=$marquee->created_at;
			$formatItem[]=$marquee->status;
			$formatItem[]=$marquee->operator;
			$formatItem[]=$marquee->updated_at;
			$formatItem[]=$action;
			$result[] = $formatItem;
		}
		// return $response->withJson($result);
		//$marquee = $marquee->toArray();
		$count = MarqueesModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}
	
	public function saveMarquee($request, $response)
    {
		$get = $request->getQueryParams();
		$post = $request->getParsedBody();
		$id = $post['edit_marquee_id'];
		
		$marquee = new MarqueesModel;
		if($id > 0){
			$marquee = MarqueesModel::find($id);
		}
		$marquee->target = $post['marquee_target'];
		$marquee->sort = $post['marquee_order'];
		$marquee->content = $post['marquee_content']['tw'];
		$marquee->release_status = $post['publish_type'];
		$marquee->release_time_start = $post['publish_start_date'] .' '.$post['publish_start_time'];
		$marquee->release_time_end = $post['publish_start_date'] .' '.$post['publish_start_time'];
		$marquee->status = isset($post['marquee_status'])?$post['marquee_status']:0;
		$marquee->operator = $_SESSION['username'];
		$marquee->created_at = date('Y-m-d H:i:s');
		$marquee->updated_at = date('Y-m-d H:i:s');
		$marquee->save();
		if($id > 0)
			$msg = Functions::showMsg('marquee_editor?etype=edit&edit_marquee_id='.$id,-2,'kangMarquee');
		else
			$msg = Functions::showMsg('marquee'.$id,-2,'kangMarquee');
		return $response->withJson($msg);
	}
	
	public function deleteMarquee($request, $response)
    {
		$get = $request->getQueryParams();
		$post = $request->getParsedBody();
		$id = $post['edit_marquee_id'];
		if($id > 0){
			MarqueesModel::destroy($id);
			$msg = Functions::showMsg('marquee',-3,'kangNews');
			return $response->withJson($msg);
		}
		 
		
	}
 
}
