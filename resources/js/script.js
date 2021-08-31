/* $(document).ready(function () {
    $('#create-student').on('submit', function (e) {
        e.preventDefault();
        let LastName = $("input[name='SLastName']").val()
        let FirstName = $("input[name='SFirstName']").val()
        let MidName = $("input[name='SMidName']").val()
        let BirthDate = $("input[name='SBirthDate']").val()
        let Id = $("select[name='CId']").val()

        $.ajax({
            method: "POST",
            url: "DataBase/create.php",
            data: {
                SLastName: LastName,
                SFirstName: FirstName,
                SMidName: MidName,
                SBirthDate: BirthDate,
                CId: Id
            }
        })
        window.location.reload()
        .done(function (msg) {
            $("input[name='SLastName']").val('')
            $("input[name='SFirstName']").val('')
            $("input[name='SMidName']").val('')
            $("input[name='SBirthDate']").val('')
        })
    })
})*/
console.log('asdasdasd');
