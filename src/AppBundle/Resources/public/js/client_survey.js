var but = $('#submit');
var surveyId = $('h1').data('id');

but.on('click', function() {
    var postData = [];
    var checkedInputs = $('input:checked');

    for(var i = 0; i < checkedInputs.length; i++) {
        if(checkedInputs[i].dataset.value == 'custom') {
            if (checkedInputs[i].nextElementSibling.value == '') {
                alert('Error! "Other" value cannot be null!');
                break
            } else {
                checkedInputs[i].value = checkedInputs[i].nextElementSibling.value;
            }
        }
        postData.push({"questionId":checkedInputs[i].name, "answer":checkedInputs[i].value});
    }

    if (postData.length == checkedInputs.length) {
        $.ajax({
            url: '/answer/add',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(postData)
        });
        window.location.replace('/answer/stats/' + surveyId);
    }

});
