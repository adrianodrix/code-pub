@push('scripts')
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
    var config = {
        toolbarGroups: [
            { name: 'tools' },
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'styles' },
            { name: 'others' }
        ],
        removeButtons: 'Underline,Subscript,Superscript',
        extraPlugins: 'markdown',
        format_tags: 'p;h1;h2;h3;pre',
        removeDialogTabs: 'image:advanced;link:advanced'
    }

    CKEDITOR.replace('content', config)
</script>
@endpush