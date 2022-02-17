function kt() {
	var name = document.getElementById('name').value;
    var pass = document.getElementById('pass').value;
    var email = document.getElementById('email').value;
	if (name == '') {
		alert('Hãy nhập tên đăng nhập');
	} else if (pass == '') {
		alert('Hãy nhập mật khẩu');
	} else if (email == '') {
		alert('Hãy nhập email');
	}
	return false;
}

function a() {
	var name = document.getElementById('name').value;
    var pass = document.getElementById('pass').value;
	if (name == '') {
		alert('Hãy nhập tên đăng nhập');
	} else if (pass == '') {
		alert('Hãy nhập mật khẩu');
	}
	return false;
}