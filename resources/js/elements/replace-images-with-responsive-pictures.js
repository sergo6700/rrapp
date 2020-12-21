$(document).ready(function (){
    $('.template-text-container img').not('.template-page-preview-img').each(function() {
        if (! this.getAttribute('srcset')) {
            return; //this is equivalent of 'continue' for jQuery loop
        }

        var img = document.createElement('img');
        img.setAttribute('src', this.getAttribute('src'))

        var source = document.createElement('source');
        source.setAttribute('srcset', this.getAttribute('srcset'));
        source.setAttribute('media', '(max-width: 835px)');

        var picture = document.createElement('picture');
        picture.appendChild(source)
        picture.appendChild(img)

        $( this ).replaceWith( picture );
    })
})