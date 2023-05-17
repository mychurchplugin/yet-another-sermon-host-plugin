document.addEventListener('DOMContentLoaded', function() {
    var copyButtons = document.querySelectorAll('.copy-button');

    copyButtons.forEach(function(button) {
        var clipboard = new ClipboardJS(button);

        clipboard.on('success', function(e) {
            // Handle successful copy
            e.clearSelection();
        });

        clipboard.on('error', function(e) {
            // Handle copy error
        });
    });
});
