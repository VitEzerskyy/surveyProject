var but = $('#submit');
var surveyId = $('h1').data('id');
var patt = new RegExp("^[a-zA-Z0-9 \?]+$");

but.on('click', function() {
    var postData = [];
    var checkedInputs = $('input:checked');

    for(var i = 0; i < checkedInputs.length; i++) {
        if(checkedInputs[i].dataset.value == 'custom') {
            if (checkedInputs[i].nextElementSibling.value == '' || patt.test(checkedInputs[i].nextElementSibling.value) == false) {
                alert('Error! "Other" field can contain only numeric or alphabetical characters');
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
