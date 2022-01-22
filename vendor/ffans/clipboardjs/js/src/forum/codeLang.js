export function codeLang() {
    var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
    var elements = document.querySelectorAll('pre code');
    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type == "attributes") {
                show_language();
            }
        });
    });

    elements.forEach(function(element){
        observer.observe(element, {
            attributes: true,
            attributeFilter: ['class']
        });
    })

    var pres = document.getElementsByTagName('pre');    
    var code_language;
    function show_language(){
        for(var i=0; i<pres.length; ++i) {
            if(pres[i].className.indexOf("language-") == -1){
                try {
                    code_language = pres[i].getElementsByTagName('code').item(0).result.language;
                    if(code_language != null && code_language != undefined && code_language != ""){
                        pres[i].classList.add("language-" + code_language);
                    }
                } catch (error) {
                    continue;
                }
            }
        }
    }
}