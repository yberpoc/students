$(document).ready(function () {
    $('.section__class-title_btn').on('click', function () {
        let current = $(this)
        let parrent = current.closest('.section__main-block')
        parrent.find('.section__table-content').toggle('d-block')
    })
})

