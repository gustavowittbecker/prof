<script>
fetch('https://httpbin.org/ip')
    .then(function(response) {
        return response.text(); 
    })
    .then(function(data) {
        console.log('data = '+ data);
    })
    .catch(function(err) {
        console.error(err);
    });
</script>