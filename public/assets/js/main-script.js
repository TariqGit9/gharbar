
    if(getCookie('guard')==false || getCookie('token')==false){
        console.log(getCookie('guard')==null);
        console.log(getCookie('guard')=="");
        console.log(getCookie('guard')==false);
        window.location.href = "http://localhost/gharbar-test";
    }
    else if("{{@$user_type}}" != getCookie('guard')){
        window.history.back()
        if(getCookie('guard')=='superadmin'){
            window.location.href = "http://localhost/gharbar-test/super-admin/index";
        }else{
            window.location.href="http://localhost/gharbar-test/"+getCookie('guard')+"/index";
        }
    }

        function getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for(let i = 0; i <ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        $(document).on('click', '.Logout', function() {
            var cookies = document.cookie.split(";");
            for (var i = 0; i < cookies.length; i++) {
                var cookie = cookies[i];
                var eqPos = cookie.indexOf("=");
                var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
                document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
            }
            location.reload();
        });


        