function ellenoriz() {
    var rendben = true;
    var fokusz = null;
    var subject = document.getElementById("subject");
    var comment = document.getElementById("comment");
    if (subject) { 
        if (subject.value.length < 4 || subject.value.length > 30 ) { 
            rendben = false;
            document.getElementById("subjectr").innerHTML ="Hibás adat";
            subject.style.background = '#f99'; 
            fokusz = subject; 
            
        } else {
            subject.style.background = '#9f9'; 
        }
    }
    if (fokusz) {
        fokusz.focus();
    }
    if (comment) { 
        if (comment.value.length < 5 || comment.value.length > 500 ) { 
            rendben = false;
            document.getElementById("commentr").innerHTML = "Hibás adat (" + String(comment.value.length) + ")";
            comment.style.background = '#f99'; 
            fokusz = comment; 
            
        } else {
            comment.style.background = '#9f9'; 
        }
    }
    if (fokusz) {
        fokusz.focus();
    }
    if (rendben) {
        return true;
    } else {
        return false; 
    }
}