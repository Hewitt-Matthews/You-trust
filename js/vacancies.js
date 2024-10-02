// window.addEventListener('load', () => {
	
// 	const additionalInfoBox = document.querySelector('.et_pb_accordion_item_4_tb_body');
// 	const additionalInfoBoxContent = document.querySelector('.et_pb_accordion_item_4_tb_body .et_pb_toggle_content').children.length;
	
// 	if(!additionalInfoBoxContent) {
// 		additionalInfoBox.remove();
// 	}
	
// })

window.addEventListener('load', () => {

	const closingDateString = document.querySelector('#closing-date-container');
	
	if (!closingDateString.innerHTML) {
    	closingDateString.parentElement.parentElement.parentElement.remove();
	} 
	
})