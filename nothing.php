<html>
<div id="output"></div>
<script>
class user {
	constructor(name, age) {
		output.innerHTML = '<p>'+name+' Age: '+age;	
	}
	add() {
		output.innerHTML = '<p>Added</p>';
	}
	delete() {
		output.innerHTML = '<p>Deleted</p>';
	}
	garage(model) {
		output.innerHTML = '<p>'+model+'</p>'; 
	}
	fibonacci() {
		var a = 0;
		var b = 1;
		var d = 0;
		for(var c = 0; c < 20; c++) {
			if ( d===0) {
				output.innerHTML += '<p>'+d+'</p>';
				d = a+b;
			} else {
				output.innerHTML += '<p>'+d+'</p>';
				d = a+b;
				a = b;
				b = d;
			}
		}	
	}
}
class admin extends user {
	edit() {
		output.innerHTML = '<p>Edit (only admin)</p>';
	}
}
const normal = new user('Tashi', 34);
normal.add();
normal.delete();

const adminp = new admin();
adminp.edit();
adminp.delete();
adminp.add();
adminp.garage('Toyota Prius V');

normal.fibonacci();

</script>
</html>

