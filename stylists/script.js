const name = document.getElementById('name');
const password = document.getElementById('password');
const form = document.getElementById('form');


form.addEventListener('submit,(e) => {
	let messages = []
	if(name.value === '' || name.value == null){
		message.push('Name is required')
	}
	 if(messages.length > 0){
	 	e.prevent 
	 }
})