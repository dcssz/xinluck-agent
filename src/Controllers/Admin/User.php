<?php
namespace App\Controllers\Admin;

use Illuminate\Database\Capsule\Manager as DB;
use stdClass;
use Interop\Container\ContainerInterface;
use App\Extensions\AdminBase;
use App\Extensions\Functions;
use App\Models\User as UserModel;
class User extends AdminBase
{
	public function __Construct(ContainerInterface $container)
    {
		parent::__Construct($container);
	}

	public function onlineCusOp($request, $response)
    {
		$get = $request->getQueryParams();
		$begin = date('Y-m-d H:i:s',time()-60000000);
	 
		$where =array();
		$where[] = array('updated_at','>=',$begin);
		$where[] = array('role','customer');
		$users = UserModel::where($where)->get();
		$result = array();
		foreach($users as $row){
			 
			//$new->release_status='<a class="status-btn status-open" href="javascript:void(0);">'._('常駐').'</a>';
			//$new->status='<a class="status-btn status-open" href="javascript:void(0);">'._('啟用').'</a>';
			$action = "--";//"<a href=\"news_editor?etype=edit&edit_news_id=".$new->id."\" class=\"btn btn-xs default\"> <i class=\"fa fa-pencil\"></i> 修改 </a>\n\t\t\t\t\t\t\t\t<a href=\"javascript:void(0);\" onclick=\"delete_item(".$new->id.");\" class=\"btn btn-xs default\"> <i class=\"fa fa-trash-o\"></i> 刪除 </a>";
		
			$formatItem = array();
			$formatItem[]=$row->username;
			$formatItem[]=$row->updated_at;
			$formatItem[]=$row->logip;
			$formatItem[]=$row->updated_at;
			$formatItem[]=$action;
			$result[] = $formatItem;
		}
		//$news = $news->toArray();
		$count = UserModel::where($where)->count();
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
		$news->status = $post['news_status'];
		$news->operator = 'admin';
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
