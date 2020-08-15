var questionId = 0;

$('.vote').on('click', function(event) {

	event.preventDefault();
    questionId = event.target.parentNode.parentNode.dataset['questionid'];
    var isVote = event.target.previousElementSibling == null;

    $.ajax({
    	method : 'POST',
    	url : urlVote,
    	data : {isVote: isVote, questionId: questionId, _token: token}
    })
    .done(function() {
        event.target.innerText = isVote ? event.target.innerText == 'Vote' ? 'You vote this post' : 'Vote' : event.target.innerText == 'Downvote' ? 'You downvote this post' : 'Downvote';
        if (isVote) {
            event.target.nextElementSibling.innerText = 'Downvote';
        } else {
            event.target.previousElementSibling.innerText = 'Vote';
        }
    });
});