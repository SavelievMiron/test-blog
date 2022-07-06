<footer class="w-full border-t bg-white pb-12">
    <div class="w-full container mx-auto flex flex-col items-center">
        <div class="flex flex-col md:flex-row text-center md:text-left md:justify-between py-6">
            <a href="#" class="uppercase px-3">About Us</a>
            <a href="#" class="uppercase px-3">Privacy Policy</a>
            <a href="#" class="uppercase px-3">Terms & Conditions</a>
            <a href="#" class="uppercase px-3">Contact Us</a>
        </div>
        <div class="uppercase pb-6">&copy; myblog.com</div>
    </div>
</footer>

@if(Route::is('dashboard'))
    @include('modals.posts.delete_post')
@endif

<!-- AlpineJS -->
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<!-- Main Quill library -->
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    function getCarouselData() {
        return {
            currentIndex: 0,
            images: [
                'https://source.unsplash.com/collection/1346951/800x800?sig=1',
                'https://source.unsplash.com/collection/1346951/800x800?sig=2',
                'https://source.unsplash.com/collection/1346951/800x800?sig=3',
                'https://source.unsplash.com/collection/1346951/800x800?sig=4',
                'https://source.unsplash.com/collection/1346951/800x800?sig=5',
                'https://source.unsplash.com/collection/1346951/800x800?sig=6',
                'https://source.unsplash.com/collection/1346951/800x800?sig=7',
                'https://source.unsplash.com/collection/1346951/800x800?sig=8',
                'https://source.unsplash.com/collection/1346951/800x800?sig=9',
            ],
            increment() {
                this.currentIndex = this.currentIndex === this.images.length - 6 ? 0 : this.currentIndex + 1;
            },
            decrement() {
                this.currentIndex = this.currentIndex === this.images.length - 6 ? 0 : this.currentIndex - 1;
            },
        }
    }

    @if(Route::is('dashboard'))
        jQuery(function ($) {
            $(document).ready(function () {
                const deletePostModal = $('#delete-post-modal')

                $('.delete-post-btn').on('click', function () {
                    deletePostModal.removeClass('hidden')
                    let postID = $(this).parents('.actions').data('post-id')

                    deletePostModal.find('input[name="post_id"]').val(postID)
                })

                $('#delete-post-modal form').on('submit', function (e) {
                    e.preventDefault()
                    let $this = $(this)

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('dashboard.posts.delete') }}',
                        data: $this.serialize(),
                        dataType: 'json',
                        success: function (response) {
                            if (response.success) {
                                closeDeletePostModal()
                                location.reload();
                            }
                        }
                    })
                })

                $('#delete-post-modal button.close-modal-btn').on('click', function () {
                    closeDeletePostModal()
                })

                function closeDeletePostModal() {
                    deletePostModal.addClass('hidden')
                    deletePostModal.find('input[name="post_id"]').val('')
                }
            })
        })
    @endif

    @if(Route::is('dashboard.posts.create') || Route::is('dashboard.posts.edit'))
        let editors = document.querySelectorAll('#editor');
        let editorInstances = [];
        if (editors.length !== 0) {
            editors.forEach(function (editor) {
                tinymce.init({
                    selector: 'textarea#editor', // Replace this CSS selector to match the placeholder element for TinyMCE
                    plugins: 'powerpaste advcode table lists checklist',
                    toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table'
                });
            })
        }

        $(document).ready(function () {
            $('select#categories').select2({
                placeholder: "Choose categories",
                allowClear: true
            })
        })
    @endif
</script>
