<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{

	protected $table = "media";
	public $_name;
	public $_reference;
	public $_mime_type;
	public $_size;
	public $_file;
	public $_disk = 'public';
	public $_path = '';

	public $fillable = ['id','name','reference','mime_type','size'];
	

	public function _save(){
		if($this->reference)
			Storage::disk('public')->delete($this->reference);

		if(!$this->_file)
			return ;


		$reference = Storage::disk($this->_disk)->put($this->_path.'/'.date('m-Y'), $this->_file);

		$this->name = ($this->_name) ? $this->_name : $this->_file->getClientOriginalName();
		$this->size = ($this->_size) ? $this->_size : $this->_file->getSize();
		$this->reference = ($this->_reference) ? $this->_reference : $reference;
		$this->mime_type = ($this->_mime_type) ? $this->_mime_type : $this->_file->getMimeType();

		if($this->id){
			$this->save();
			return $this;
		}else{
			return Media::create([
	            'name'=>$this->name,
	            'reference'=>$this->reference,
	            'size'=>$this->size,
	            'mime_type'=>$this->mime_type
	        ]);
		}
	}

	public function delete()
	{
		if($this->reference)
			Storage::disk('public')->delete($this->reference);

	    parent::delete();
	}

    public function picture($w=40,$h=40){
        $src = asset('storage/'.$this->reference);
        return '<a href="'.$src.'" target="_blank"><img class="img-xs" style="width: '.$w.'px;height: '.$h.'px;" src="'.$src.'"></a>';
    }

    public function link(){
        return asset('storage/'.$this->reference);
    }

}
