<?php

function title(){
	return '';

    $controller = Request::route()->controller;
    $model = $controller->model;
    if($model){
	    $currentAction = Request::route()->action['as'];
	    return ucfirst(__($controller->model.'.'.$currentAction));
    }

	return '';
}


function isGranted($role){
	return auth()->user()->isGranted($role);
}

function list_actions($object){
	
	$class = get_class($object);
	$path = explode('\\', $class);
    $object_class = array_pop($path);

    $_class_upper = strtoupper($object_class);
    $_class_lower = strtolower($object_class);

	$html = '';
	
	if( method_exists($object, 'list_actions') ){
            $html .= $object->list_actions();
        }

	// if( isGranted('ROLE_'.$_class_upper.'_SHOW') )
	// 	$html .= '<a href="'.route($_class_lower.'_show',$object->id).'" class="icon pl-3"><i class="fa fa-eye"></i></a>';
	
	if( isGranted($_class_lower) && Route::has($_class_lower.'_edit',$object->id) )
		$html .= '<a href="'.route($_class_lower.'_edit',$object->id).'" class="icon pl-3"><i class="fa fa-edit"></i></a>';
	
	if( isGranted($_class_lower) && Route::has($_class_lower.'_delete',$object->id) )
		$html .= '<a href="'.route($_class_lower.'_delete',$object->id).'"  type="button" data-toggle="modal" data-target="#confirmdelete" class="delete_btn icon pl-3"><i class="fa fa-trash"></i></a>';

	return $html;
}

function base_list($results){

	$controller = Request::route()->controller;
	$f = $controller->filter();

	$fields = $f->fields;
	$filter = $f->filter;
	$model = $f->model;

	$html ='<div class="card">';
		$html .= '<div class="card-header">';
			$html .= '<h3 class="card-title">'.__(strtolower($model).'.list_').'</h3>';

			$html .= '<div class="card-options">';
				if( isGranted($model) && Route::has(strtolower($model)."_create") )
                	$html .= '<a class="btn btn-link" href="'.route(strtolower($model)."_create").'"><i class="fa fa-plus"></i>&nbsp;'. __('global.add').'</a>';
			$html .= '</div>';
		$html .= '</div>';

      	$html .= '<div class="table-responsive">';
	        $html .= '<table class="table table-hover table-striped stable-outline table-vcenter text-nowrap card-table">';
	          	$html .= '<thead class="">';
	            	$html .= '<tr class="fields">';
	              		$html .= '<th class="text-center w-1"><i class="icon-people"></i></th>';
	              		foreach ($fields as $key => $value) {
	              			$html .= '<th class="text-center">'.__($model.'.'.$key).'</th>';
	              		}
	              		$html .= '<th></th>';
	            	$html .= '</tr>';
              		$html .= $filter;
              		//$html .= '<th class="text-center w-1"><i class="icon-people"></i></th>';
	          	$html .= '</thead>';
	          	$html .= '<tbody>';

	          		foreach ($results as $object ) {
			            $html .= '<tr>';
			            	$html .= '<td>';
	                        	$html .= '<label class="custom-control custom-checkbox" for="idx'.$object->id.'">';
	                            	$html .= '<input type="checkbox" class="custom-control-input" name="idx[]" value="'.$object->id.'" id="idx'.$object->id.'">';
	                            	$html .= '<span class="custom-control-label"></span>';
	                          	$html .= '</label>';
			            	$html .= '</td>';
		              		foreach ($fields as $key => $value) {
		              			$geter = 'get'.$key;
				            	$html .= '<td class="td-'.$key.'">'.$object->$geter().'</td>';
		              		}
		              		
		              		$html .= '<td class="text-right">';
		              			$html .= list_actions($object);
	                        $html .= '</td>';
			            $html .= '</tr>';
              		}

	          	$html .= '</tbody>';
	        $html .= '</table>';
	    $html .= '</div>';

		$html .= '<div class="card-header card-footer">';
			$html .= '<div class="card-">';
				$html .= '<select class="per-page w-9 custom-select" id="perpage">';

	                $pages__ = [16,32,64,128,192];
	                $currnt_page__ = $controller->perpage();
	                $url__ = $controller->url_params(true,['perpage'=>'mypagenull']);

	                foreach ($pages__ as $perpage) {
	                	$selected = ( $perpage == $currnt_page__ ) ? 'selected="selected"' : '';

	                	$html .= '<option '.$selected.' value="'.str_replace('mypagenull', $perpage, $url__).'">'.$perpage.'</option> ';
	                }
	            $html .= '</select>';

	            if($results) 
	            	$html .=  __('global.pages_list',[
	                  'current'=> $results->currentPage(),
	                  'length'=> $results->lastPage(),
	                  'total'=> $results->total(),
	                  'module'=>__($model.'.'.$model)
	                ]);
			$html .= '</div>';
			$html .= '<div class="card-options">';
				$html .= $results->links();
			$html .= '</div>';
		$html .= '</div>';
    $html .= '</div>';

	echo $html;
}