
function getIp(callback) {
	function response(s) {
		callback(window.userip);
		s.onload = s.onerror = null;
		document.body.removeChild(s);
	}

	function trigger() {
		window.userip = false;
		var s = document.createElement("script");
		s.async = true;
		s.onload = () => response(s);
		s.onerror = () => response(s);
		s.src = "https://l2.io/ip.js?var=userip";
		document.body.appendChild(s);
	}

	if (/^(interactive|complete)$/i.test(document.readyState)) {
		trigger();
	} else {
		document.addEventListener('DOMContentLoaded', trigger);
	}
}

function exibirIp() {
	getIp(function (ip) {
		alert("Seu ip é:" + ip + ':D');
	});
}
