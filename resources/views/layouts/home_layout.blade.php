<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        #container {
            width: 1000px;
            margin: 20px auto;
        }
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }
        .ck-content .image {
            /* block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script type="text/javascript">
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
	</script>
</head>
<body>

    @include('components.home.header')
    <div class="container-fluid">
        <div class="row">
            @include('components.home.navbar')
            <div class="content col-8">
                @yield('content')
            </div>
            @include('components.home.chat')
        </div>
    </div>
    @vite(['resources/assets/home/css/header.css',
    'resources/assets/home/css/navbar.css',
    'resources/assets/home/css/content.css',
	'resources/assets/home/css/chat.css',
	'resources/assets/home/css/comment.css'])
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/3ec5aa8ff1.js" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/super-build/ckeditor.js"></script>
<!--
	Uncomment to load the Spanish translation
	<script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/super-build/translations/es.js"></script>
-->
<script>
	// This sample still does not showcase all CKEditor 5 features (!)
	// Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
	CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
		// https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
		toolbar: {
			items: [
				'exportPDF','exportWord', '|',
				'findAndReplace', 'selectAll', '|',
				'heading', '|',
				'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
				'bulletedList', 'numberedList', 'todoList', '|',
				'outdent', 'indent', '|',
				'undo', 'redo',
				'-',
				'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
				'alignment', '|',
				'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
				'specialCharacters', 'horizontalLine', 'pageBreak', '|',
				'textPartLanguage', '|',
				'sourceEditing'
			],
			shouldNotGroupWhenFull: true
		},
		// Changing the language of the interface requires loading the language file using the <script> tag.
		// language: 'es',
		list: {
			properties: {
				styles: true,
				startIndex: true,
				reversed: true
			}
		},
		// https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
		heading: {
			options: [
				{ model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
				{ model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
				{ model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
				{ model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
				{ model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
				{ model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
				{ model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
			]
		},
		
		// https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
		fontFamily: {
			options: [
				'default',
				'Arial, Helvetica, sans-serif',
				'Courier New, Courier, monospace',
				'Georgia, serif',
				'Lucida Sans Unicode, Lucida Grande, sans-serif',
				'Tahoma, Geneva, sans-serif',
				'Times New Roman, Times, serif',
				'Trebuchet MS, Helvetica, sans-serif',
				'Verdana, Geneva, sans-serif'
			],
			supportAllValues: true
		},
		// https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
		fontSize: {
			options: [ 10, 12, 14, 'default', 18, 20, 22 ],
			supportAllValues: true
		},
		// Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
		// https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
		htmlSupport: {
			allow: [
				{
					name: /.*/,
					attributes: true,
					classes: true,
					styles: true
				}
			]
		},
		// Be careful with enabling previews
		// https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
		htmlEmbed: {
			showPreviews: true
		},
		// https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
		link: {
			decorators: {
				addTargetToExternalLinks: true,
				defaultProtocol: 'https://',
				toggleDownloadable: {
					mode: 'manual',
					label: 'Downloadable',
					attributes: {
						download: 'file'
					}
				}
			}
		},
		// https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
		mention: {
			feeds: [
				{
					marker: '@',
					feed: [
						'@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
						'@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
						'@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
						'@sugar', '@sweet', '@topping', '@wafer'
					],
					minimumCharacters: 1
				}
			]
		},
		// The "super-build" contains more premium features that require additional configuration, disable them below.
		// Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
		removePlugins: [
			// These two are commercial, but you can try them out without registering to a trial.
			// 'ExportPdf',
			// 'ExportWord',
			'CKBox',
			'CKFinder',
			'EasyImage',
			// This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
			// https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
			// Storing images as Base64 is usually a very bad idea.
			// Replace it on production website with other solutions:
			// https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
			// 'Base64UploadAdapter',
			'RealTimeCollaborativeComments',
			'RealTimeCollaborativeTrackChanges',
			'RealTimeCollaborativeRevisionHistory',
			'PresenceList',
			'Comments',
			'TrackChanges',
			'TrackChangesData',
			'RevisionHistory',
			'Pagination',
			'WProofreader',
			// Careful, with the Mathtype plugin CKEditor will not load when loading this sample
			// from a local file system (file://) - load this site via HTTP server if you enable MathType
			'MathType'
		]
	});
</script>

</html>