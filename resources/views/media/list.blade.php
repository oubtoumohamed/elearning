@extends('standard')

@section('head')

    <link rel="stylesheet" type="text/css" href="{{ asset('NextAdmin/js/jstree/style.css') }}">
    <script src="{{ asset('NextAdmin/js/jstree/jstree.min.js') }}"></script>
@endsection

@section('content')

	@section('export')
	@endsection
	@section('paginate')
	@endsection
	@section('limit')
	@endsection


	<script type="text/javascript">
		jQuery(function ($){
		 	$('#treem_0').jstree({
			    "core" : {
			      "animation" : 0,
			        "themes" : {
			            "responsive": false
			        }
			    },
			    "types" : {
			        "default" : {
			            "icon" : "fa fa-folder icon-state-warning icon-lg"
			        },
			        "file" : {
			            "icon" : "fa fa-file icon-state-warning icon-lg"
			        }
			    },
			    "plugins": ["types"]
		  	});
		  	$('#treem_0').show();

			$('.apercu_btn').on('click',function(e){
			    e.preventDefault();
			    if(this.href.indexOf('.pdf') != -1)
			      $("#cpsfile .modal-body").html('<iframe src="'+this.href+'" ></iframe>');
			    else
			      $("#cpsfile .modal-body").html('<img src="'+this.href+'" >');
			    $("#cpsfile").modal();
		  	});

		  	$('.see_btn').on('click',function(e){
			    e.preventDefault();
			    $('#cartoonVideo').attr('src',$(this).attr('data-src') );
			    $('#myModal').modal();
		  	});



		 	$('.tree_class').on('select_node.jstree',function(index,data){

		    	$('.tr_files').hide();

		    	if(data.node.children.length>0){
			     	data.instance.open_node(data.node);
			    }

			    for(var i=0; i<data.node.children.length; i++){

			      data.instance.open_node(data.node.children[i]);
			      var nodec = data.instance.get_node(data.node.children[i]);

			      for(var j=0; j<nodec.children.length; j++){
			        var id  = $('#'+nodec.children[j]).find('a').attr('id');
			        $('.'+id).show();
			      }
			      
			      var id  = $('#'+data.node.children[i]).find('a').attr('id');
			      $('.'+id).show();

			    }

		 		if(data.node.children.length==0){
			   		var id  = $('#'+data.node.id).find('a').attr('id');
			   		$('.tr_files').hide();
			   		$('.'+id).show();
			   	}

			    if($('.tr_files').filter(function() {
			        return $(this).css('display') !== 'none';
			    }).length == 0){
			    	$('#no_item').show();
			    }else{
			    	$('#no_item').hide();
			    }


		 	});

		 	$('#marches_select').on('change',function(){
				var x = this.value;
		    	$(".tree_class").hide();
			    // $(".tree_class").each(function(){
			    // 	$(this).jstree("hide_all");
			    // });
			    $('#treem_'+x).jstree({
			      "animation" : 0,
			        "core" : {
			            "themes" : {
			                "responsive": false
			            }            
			        },
			        "types" : {
			            "default" : {
			                "icon" : "fa fa-folder icon-state-warning icon-lg"
			            },
			            "file" : {
			                "icon" : "fa fa-file icon-state-warning icon-lg"
			            }
			        },
			        "plugins": ["types"]
			    });
			    //$("#treem_"+x).jstree("hide_all");

		 		$("#treem_"+x).jstree("close_all");
		 		$("#treem_"+x).jstree("show_all");

			   	$('.tr_files').hide();
			    $('#treem_'+x).show();
			   	$('#event_result').show();
			    if(parseInt(x)!=0){
			      $('#marche_nom').text($("#marches_select option:selected").text());
			    }
			    else{
			    	$('#marche_nom').text('Tous les Marchés');
			    }
		  	});
		});
	</script>

	<style type="text/css">
		.tr_files a.btn {
			padding: 0 5px;
			margin: 0 4px;
		}
		#table-1 td:nth-child(1) {
			text-align: left;
		}
		#table-1 td{
			padding: 5px;
		}
	</style>

	<div class="col-md-5">
		<h3>{{__('media.module')}}</h3>
		<div id="treem_0" class="tree-demo tree_class">
		  <ul>
		  	<?php
		  		$modelsdata = '';
		  		$i=0;

		  		foreach( $bundle as $name=>$objects ){
		  			$i++;
			  		echo "<li id='parent$i' data-jstree='{ \"type\" : \"file\" }'> ".__('menu.'.$name);
			    		if($objects){
			    			echo '<ul>';
			    			foreach ($objects as $object) {
			    				$title_ = $object->__toString();
			    				echo "<li data-jstree='{ \"type\" : \"file\" }'><a title=\"$title_\" id='li_$i-$object->id' href='javascript:;'>".$object->__toString()."</a></li>";
			    				
			    				$modelsdata .= "<tr style=\"display:none\" class='tr_files parent$i li_$i-$object->id''>";
				    				//$modelsdata .= "<td> ".$object->picture->id." </td>";
				    				$modelsdata .= "<td> ".$object->picture->name." </td>";
				    				$modelsdata .= "<td> ".$object->picture->created_at->format('d/m/Y')." </td>";
				    				if( auth()->user() and auth()->user()->isGranted('ROLE_MEDIA_SHOW') ){
				    					$modelsdata .= "<td style='white-space: nowrap;text-align: right;'>";
				    					$url = asset("storage/".$object->picture->reference);
				    					$tab=explode('.', $object->picture->reference);
				                        $ext = $tab[1]; 
				                        $name = $tab[0];
				                        if(in_array($ext,['png','jpg','gif','doc','docx','pdf','txt'])){
				                            $downloadname = $object->picture->name;
				    						$modelsdata .= "<a download=".$downloadname." target='_blank' href=".$url."><button type='button' class='btn blue start'><i class='fa fa-download'></i></button></a>";
				    					}
				    					if(in_array($ext,['pdf','png','jpg','jpeg','gif'])){ 
				    					 	$modelsdata .= "<a class='apercu_btn' href=".$url."><button type='button' class='btn green start'><i class='fa fa-eye'></i></button></a>";
				    					}
				    					$modelsdata .= "</td>";
				    				}
			    				$modelsdata .= "</tr>";
			    			}
			    			echo "</ul>";
			    		}
			    	echo "</li>";
			    }
		    ?>
		  </ul>
		</div>
	</div>
	<div class="col-md-7" style="padding: 3px;margin-top: 12px;">
		<table id="table-1" class="table table-bordered table-striped ba-list" style="width: 100%;">
		  <thead>
		    <tr>
				<th>{{ __('media.name') }}</th>
				<th style="width:  90px;">{{ __('media.created_at') }}</th>
				<th style="width:  108px;">{{ __('global.actions') }}</th>
		    </tr>
		  </thead>
			<tbody>
				<?php echo $modelsdata; ?>
				<tr class="tr_files" id="event_result">
					<td colspan="3">
						<center><h6>{{__('media.aucun_result')}}</h6></center>
					</td>
	            </tr>
			</tbody>
		</table>
	</div>
@endsection