<?php
namespace App\Controllers\Admin;

use Illuminate\Database\Capsule\Manager as DB;
use stdClass;
use Interop\Container\ContainerInterface;
use App\Extensions\AdminBase;
use App\Extensions\Functions;
use App\Models\News as NewsModel;
class News extends AdminBase
{
	public function __Construct(ContainerInterface $container)
    {
		parent::__Construct($container);
	}

	public function listNews($request, $response)
    {
		$get = $request->getQueryParams();
		$where = array();
		//$where[] = array('status',1);
		if(isset($get['select_status']) &&  $get['select_status'] != '-1' )
			$where[] = array('status',$get['select_status']);
		if(isset($get['select_news_target']) &&  $get['select_news_target'] != '-1' )
			$where[] = array('target',$get['select_news_target']);
		$start = 0;
		if(isset($get['start']))
			$start = intval($get['start']);
		
		$length = 0;
		if(isset($get['length']))
			$length = intval($get['length']);

		$news = NewsModel::select('target','sort','content','release_time_start','release_status','is_window','announcement_time','status','operator','updated_at','id')->where($where)->skip($start)->take($length)->get();
		$result = array();
		foreach($news as $new){
			if($new->target === 3)
				$new->target = _('所有');
			elseif($new->target === 1)
				$new->target =  _('会员');		
			elseif($new->target === 2)
				$new->target =  _('代理');
			else
				$new->target =  $new->target;
			
			$new->release_status='<a class="status-btn status-open" href="javascript:void(0);">'._('常駐').'</a>';
			
			if ($new->status == 1) {
				$new->status='<a class="status-btn status-open" href="javascript:void(0);">'._('啟用').'</a>';
			} else {
				$new->status='<a class="status-btn status-close" href="javascript:void(0);">'._('停用').'</a>';
			}
			$action = "<a href=\"news_editor?etype=edit&edit_news_id=".$new->id."\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>\n\t\t\t\t\t\t\t\t<a href=\"javascript:void(0);\" onclick=\"delete_item(".$new->id.");\" class=\"btn btn-xs default\"> <i class=\"fa fa-trash-o\"></i> 刪除 </a>";
		
			$formatItem = array();
			$formatItem[]=$new->target;
			$formatItem[]=$new->sort;
			$formatItem[]=$new->content;
			$formatItem[]=$new->release_time_start;
			$formatItem[]=$new->release_status;
			$formatItem[]=$new->is_window;
			$formatItem[]=$new->announcement_time;
			$formatItem[]=$new->status;
			$formatItem[]=$new->operator;
			$formatItem[]=$new->updated_at;
			$formatItem[]=$action;
			$result[] = $formatItem;
		}
		//$news = $news->toArray();
		$count = NewsModel::where($where)->count();
		if($result == null)$result = [];
		$draw = 1;
		if(isset($get['draw']))
			$draw = intval($get['draw']);
		$result = Functions::listData($draw ,$count,$count,$result);
		return $response->withJson($result);
	}
	
	public function saveNews($request, $response)
    {
		$get = $request->getQueryParams();
		$post = $request->getParsedBody();
		$id = $post['edit_news_id'];
		
		$news = new NewsModel;
		if($id > 0){
			$news = NewsModel::find($id);
		}
		$news->target = $post['news_target'];
		$news->sort = $post['news_order'];
		$news->content = $post['news_content']['tw'];
		$news->release_status = $post['publish_type'];
		$news->release_time_start = $post['publish_start_date'] .' '.$post['publish_start_time'];
		$news->release_time_end = $post['publish_start_date'] .' '.$post['publish_start_time'];
		$news->is_window = $post['news_alert'];
		$news->status = isset($post['news_status'])?$post['news_status']:0;;
		$news->operator = $_SESSION['username'];
		$news->created_at = date('Y-m-d H:i:s');
		$news->updated_at = date('Y-m-d H:i:s');
		$news->save();
		if($id > 0)
			$msg = Functions::showMsg('news_editor?etype=edit&edit_news_id='.$id,-2,'kangNews');
		else
			$msg = Functions::showMsg('news'.$id,-2,'kangNews');
		return $response->withJson($msg);
	}
	
	public function deleteNews($request, $response)
    {
		$get = $request->getQueryParams();
		$post = $request->getParsedBody();
		$id = $post['edit_news_id'];
		if($id > 0){
			NewsModel::destroy($id);
			$msg = Functions::showMsg('news',-3,'kangNews');
			return $response->withJson($msg);
		}
		 
		
	}
 
}
