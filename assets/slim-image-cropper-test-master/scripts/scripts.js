var cropper = new Slim(document.getElementById('profile_images'), {
	ratio: '1:1',
	minSize: {
		width: 350,
		height: 350,
	},
	size: {
		width: 350,
		height: 350,
	},
	download: true,
	instantEdit: true,
	label: 'Click to upload image here.',
	buttonConfirmLabel: 'Confirm',
	buttonConfirmTitle: 'Confirm editing',
//	buttonCancelLabel: 'Cancel',
//	buttonCancelTitle: 'Cancel Editing',
	buttonEditTitle: 'Edit Image',
	buttonRemoveTitle: 'Removed Image',
	buttonDownloadTitle: 'Download Image',
	buttonRotateTitle: 'Rotate',
	buttonUploadTitle: 'Upload',
	statusImageTooSmall:'This picture is too small. The minimum size is 350*350 pixel.'
});
var cropper2 = new Slim(document.getElementById('id_proofs'), {
	ratio: '1:1',
	minSize: {
		width: 350,
		height: 350,
	},
	size: {
		width: 350,
		height: 350,
	},
	download: true,
	upload:true,
	instantEdit: true,
	label: 'Click to upload image here.',
	buttonConfirmLabel: 'Confirm',
	buttonConfirmTitle: 'Confirm editing',
	buttonCancelLabel: 'Cancel',
	buttonCancelTitle: 'Cancel Editing',
	buttonEditTitle: 'Edit Image',
	buttonRemoveTitle: 'Removed Image',
	buttonDownloadTitle: 'Download Image',
	buttonRotateTitle: 'Rotate',
	buttonUploadTitle: 'Upload',
	statusImageTooSmall:'This picture is too small. The minimum size is 350*350 pixel.'
});