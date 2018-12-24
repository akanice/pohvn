/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	
	//KCFinder      
	// config.filebrowserBrowseUrl = '/assets/plugins/kcfinder/browse.php?opener=ckeditor&type=files';      
	// config.filebrowserImageBrowseUrl = '/assets/plugins/kcfinder/browse.php?opener=ckeditor&type=images';      
	// config.filebrowserFlashBrowseUrl = '/assets/plugins/kcfinder/browse.php?opener=ckeditor&type=flash';      
	// config.filebrowserUploadUrl = '/assets/plugins/kcfinder/upload.php?opener=ckeditor&type=files';      
	// config.filebrowserImageUploadUrl = '/assets/plugins/kcfinder/upload.php?opener=ckeditor&type=images';     
	// config.filebrowserFlashUploadUrl = '/assets/plugins/kcfinder/upload.php?opener=ckeditor&type=flash';
	
	config.extraPlugins = 'imageuploader';
	config.filebrowserUploadMethod = 'form';
};
