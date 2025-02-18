<html>
    <head>
        <?php
            include '../../components/navbar.php';
        ?>
        <style>
            <?php include "connor.css"; ?>
        </style>
    </head>
    <body>
        <audio id="kick" controls style="display:none">
            <source src="../../components/kick.mp3" type="audio/mpeg"> Your browser does not support the audio element.
        </audio>
        <audio id="snare" controls style="display:none">
            <source src="../../components/snare.mp3" type="audio/mpeg"> Your browser does not support the audio element.
        </audio>
        <script>
            document.addEventListener('keydown', function(e) {
                if (e.keyCode == 75) {
                    document.getElementById('kick').play();
                }
                else if (e.keyCode == 83) {
                    document.getElementById('snare').play();
                }
            });
            
        </script>
        <div style="background-image: url('../../components/echoplex.jpg'); background-size: 1600px;">
            <br>
            <p>For their Lights in the Sky 2009 tour, the band Nine Inch Nails worked with Moment Factory to incorporate a large touchscreen drum machine to be used in real-time for performances of the song "Echoplex".</p>
            <br>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/QQGUH3A7WrQ?si=tgzDgDBlFFXMBTJo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            <br>
            <p>This drum machine was eventually turned into a mobile app and was made available on the app store.</p>
            <br>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/X29goInVYZs?si=G-Ur3dEg_EPFRA3k" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            <br>
            <p>While this page is not a recreation of the drum machine app, you can play the kick and snare samples by pressing <b>K</b> and <b>S</b> on your keyboard! Give it a try!</p>
            <br>
        </div>
    </body>
</html>