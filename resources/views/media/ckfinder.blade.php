<!DOCTYPE html>
<!--
Copyright (c) 2007-2019, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or https://ckeditor.com/sales/license/ckfinder
-->
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
	<title>CKFinder 3 - File Browser</title>
</head>
<body>
<script src="{{ asset('/ckfinder/ckfinder.js') }}"></script>
<script type="text/javascript">
	
var config = {};
// Examples:
config.language = 'fr';
config.selectMultiple = true;
// config.skin = 'jquery-mobile';

config.connectorPath = '{{ route("media_connector")}}';

//CKFinder.define( config );
CKFinder.start(config);

</script>

</body>
</html>

