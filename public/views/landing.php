
<script>



  $(function(){
      $(".element1").typed({
        strings: ["<font color='#64BFFF'>$sessionid1</font> = <font color='#64BFFF'>$_COOKIE</font>[<font color='#DB6275'>'sessionid1'</font>];<br><font color='#64BFFF'>$sessionid2</font> = <font color='#64BFFF'>$_COOKIE</font>[<font color='#DB6275'>'sessionid2'</font>];<br><font color='#64BFFF'>$type</font> = <font color='#64BFFF'>$_COOKIE</font>[<font color='#DB6275'>'type'</font>];<br>include_once(<font color='#DB6275'>'connect.php'</font>);<br>if(<font color='#64BFFF'>$type</font> == <font color='#DB6275'>'Host'</font>)<br>{<br><font color='#64BFFF'>$sql</font> = <font color='#DB6275'> ^1000 \"SELECT Username, SessionID1, SessionID2 FROM Hosts WHERE SessionID1 = '$sessionid1'\"</font>;<br><font color='#64BFFF'>$resultQ</font> = mysqli_query($link, $sql);<br>}", "Second sentence."],
        typeSpeed: 0,
        loop: true,
        backSpeed: 1,

      });
      $(".element2").typed({
        strings: ["<font color='#64BFFF'>$sessionid1</font> = <font color='#64BFFF'>$_COOKIE</font>[<font color='#DB6275'>'sessionid1'</font>];<br><font color='#64BFFF'>$sessionid2</font> = <font color='#64BFFF'>$_COOKIE</font>[<font color='#DB6275'>'sessionid2'</font>];<br><font color='#64BFFF'>$type</font> = <font color='#64BFFF'>$_COOKIE</font>[<font color='#DB6275'>'type'</font>];<br>include_once(<font color='#DB6275'>'connect.php'</font>);<br>if(<font color='#64BFFF'>$type</font> == <font color='#DB6275'>'Host'</font>)<br>{<br><font color='#64BFFF'>$sql</font> = <font color='#DB6275'> ^1000 \"SELECT Username, SessionID1, SessionID2 FROM Hosts WHERE SessionID1 = '$sessionid1'\"</font>;<br><font color='#64BFFF'>$resultQ</font> = mysqli_query($link, $sql);<br>}", "Second sentence."],
        typeSpeed: 0,
        loop: true,
        backSpeed: 1,

      });
  });
</script>
<div class="section_main">
  <div class="section_main_title">Coding languages are complicated.
  Expressing experience in them shouldn't be.<br>
  <a href="create.php">
  <button class="section_main_button">Create a Langfolio</button></a>
  </div>
<div class="element1"></div>

<div class="element2 flip"></div>

</div>
<div class="section">
  <h2><b>What is a Langfolio?</b>  A portfolio that showcases not only what languages you
  know, but to what depth you know those languages.  Current resumes and CVs lack the room to showcase
the complexity of your knowledge of a certain language.  Terms expert and beginner also are vague:
I can be versed in PHP but not used to PDO mySQL strategies.  Langfolio is a place to express the
exact knowledge you know of a particular language and associated APIs - programming is complex
but also incorporates a lot of cross-over: a dynamic portfolio helps best express that. </h2>
    <div class="langfolio">
      <div class="section w95 mb20 txtwhite">
          <img src="img/sample.png" class="lang_img">
          <h5>
          Preston Abbot | <b>Langfolio</b>

        </h5>

      </div>
      <div class="section">

      <div class="langenvelope">

            <div class="lang">
              <h1>HTML</h1>
              <div class="cards">
                  <div class="card">Main Syntax</div>
                  <div class="card">Tables</div>
                  <div class="card">Canvas</div>
                  <div class="card">Forms</div>
                  <div class="card">Linking Files</div>
                  <div class="card">Redirect</div>
                  <div class="card">Meta Tags</div>

              </div>
            </div>

            <div class="lang bgbaige">
              <h1>Stripe API</h1>
              <div class="cards">
                  <div class="card">Payments</div>
                  <div class="card">Capture & Auth</div>
                  <div class="card">Stripe Connect</div>
                  <div class="card">Discounts</div>


              </div>
            </div>

            <div class="lang bglightred">
              <h1>Amazon AWS API</h1>
              <div class="cards">
                  <div class="card">Authorization</div>
                  <div class="card">S3</div>




              </div>
            </div>

            <div class="lang bggreen">
              <h1>Wordpress CMS</h1>
              <div class="cards">
                  <div class="card">Plugins</div>
                  <div class="card">Design</div>
                  <div class="card">Sticky Footer</div>
                  <div class="card">Multisite</div>
                  <div class="card">Facebook Connect</div>
                  <div class="card">Twitter Connect</div>




              </div>
            </div>

        </div>
        <div class="langenvelope">

      <div class="lang bglightblue">
        <h1>CSS</h1>
        <div class="cards">
            <div class="card">Main Syntax</div>
            <div class="card">Transform</div>
            <div class="card">Animations</div>
            <div class="card">@media</div>
            <div class="card">@keyframes</div>

        </div>
        <div class="banner">Libraries</div>
        <div class="cards">
            <div class="card">Bootstrap</div>
            <div class="card">JQuery UI</div>
            <div class="card">Foundation</div>


        </div>
        <div class="banner">Extensions</div>
        <div class="cards">

        <div class="card">SASS</div>
        <div class="card">LESS</div>
      </div>


      </div>
      <div class="lang bglightpurple">
        <h1>Java</h1>
        <div class="cards">
            <div class="card">Basic Syntax</div>
            <div class="card">Constructors</div>
            <div class="card">Classes/Objects</div>
            <div class="card">IOStream</div>
            <div class="card">HashMaps</div>
            <div class="card">Arrays</div>
            <div class="card">ArrayLists</div>




        </div>
      </div>
    </div>
    <div class="langenvelope">

      <div class="lang bglightred">
        <h1>Javascript</h1>
        <div class="cards">
            <div class="card">Callbacks</div>
            <div class="card">Log</div>
            <div class="card">Syntax</div>
            <div class="card">DOM</div>
            <div class="card">Variables</div>
            <div class="card">Nested Functions</div>


        </div>
        <div class="banner">Frameworks</div>
        <div class="cards">

        <div class="card ext">NodeJS</div>
      </div>
        <div class="banner">Libraries</div>
        <div class="cards">
            <div class="card">JQuery</div>
            <div class="card">ChartJS</div>
            <div class="card">ReactJS</div>
            <div class="card">Angular.js</div>



        </div>
        <div class="banner">JQuery Extensions</div>
        <div class="cards">
            <div class="card">TypedJS</div>
            <div class="card">Plumb.js</div>


        </div>


      </div>
      <div class="lang">
        <h1>Ruby</h1>
        <div class="cards">
            <div class="card">Basic Syntax</div>





        </div>
        <div class="banner">Frameworks</div>
        <div class="cards">

        <div class="card">Ruby on Rails</div>


      </div>
      </div>
</div>
<div class="langenvelope">

      <div class="lang bglightpurple">
        <h1>PHP</h1>
        <div class="cards">
            <div class="card">General Syntax</div>
            <div class="card">OOP in PHP</div>
            <div class="card">Arrays</div>
            <div class="card">mySQL PDO</div>
            <div class="card">mySQL functions</div>
            <div class="card">mySQLi functions</div>
            <div class="card">postgres functions</div>
            <div class="card">Header</div>
            <div class="card">Loops</div>
            <div class="card">$_GET</div>
            <div class="card">$_POST</div>
            <div class="card">cookies</div>


        </div>
        <div class="banner">Frameworks</div>
        <div class="cards">

        <div class="card">Laravel</div>
        <div class="card">OctoberCMS</div>
        <div class="card ext">Wordpress</div>

      </div>

        <div class="banner">Tools</div>
        <div class="cards">
            <div class="card">Composer</div>


        </div>

        <div class="banner">APIs</div>
        <div class="cards">
            <div class="card">AmazonAWS</div>
            <div class="card">Mailgun</div>
            <div class="card">Stripe</div>
            <div class="card">Facebook API</div>
            <div class="card">Twitter API</div>


        </div>


      </div>
      <div class="lang bgbaige">
        <h1>C++</h1>
        <div class="cards">
            <div class="card">Basic Syntax</div>





        </div>

      </div>
</div>


    </div>
  </div>

</div>
