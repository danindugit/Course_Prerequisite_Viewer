<html>
    <head>
        <title>Graham's PHP Demo</title>
        <link rel="icon" type="image/x-icon" href="components/course_finder_icon.png">
    </head>
    <body>
        <?php
            include '../../components/navbar.php';

            $messages = array(
                "I build keyboards! So far I only have one keyboard in my collection, but I'll be building my second early October!",
                "I love rock climbing! I specifically boulder, and I aim to climb three times weekly. My highest grade is a V5.",
                "I build computers! Starting back in 2014, I've so far built over ten distinct systems for myself, friends, and family.",
                "I have four years of experience as a Dungeon Master for Dungeons and Dragons. I hosted my own campaign for eight friends for over three years.",
                "I love writing. I want to write a book one day, as I have a passion for fiction.",
                "My favouirte game on the Nintendo Gamecube is SSX 3. Check it out sometime."
            );

            $the_message = $messages[rand(0, count($messages) - 1)];
        ?>
        <div class="container">
            <div class="title text-center">
                <h2 class="text-uppercase my-5">Graham Quinlan PHP Demo</h2>
            </div>
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img class="img-fluid rounded-start rounded-end" src="../../components/graham.jpg">
                    </div>
                    <div class="col-md-4">
                        <div class="card-body" style="text-align:center">
                            <h3 class="card-title">About myself...</h3>
                            <p class="card-body">My name is Graham Quinlan. I am a fourth year software engineering student at the University of Guelph. My hobbies are plentiful and varied. Find out more below!</p>
                            <form>
                                <?php
                                    if(isset($_POST['submit']))
                                    {
                                        $the_message = $messages[rand(0, count($messages) - 1)];
                                    }
                                ?>
                                <button class="btn btn-danger btn-lg" type="submit" name="submit">Get a random fact</button>
                            </form>
                            <hr class="hr" />
                            <h3 class="fact-title">Here's a random fact about myself:</h3>
                            <p class="random-fact"><?php echo $the_message ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </body>
</html>

