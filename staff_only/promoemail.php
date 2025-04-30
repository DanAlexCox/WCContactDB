<?php
//Design the 4 layouts
    //Layout 1. 
    $body1 = "<div id='emailbody' style='width: 80%; margin: auto; border: 2px solid black; padding: 2%; box-sizing: border-box;'>
          <div id='heading' style='text-align: center; margin-bottom: 40px;'>
            <div id='logo'>
              <img src='CSS/images/logo.png' alt='logo.png'>
            </div>
            <h1>See what is coming soon</h1>
          </div>
          <div id='layout' style='display: grid; grid-template-columns: repeat(2, 1fr); gap: 2%;'>
            <section id='left'>
              <section class='eventpart left top' style='display: flex; flex-direction: column; align-items: center; justify-content: space-between;
                padding: 2%; width: 100%; border: 1px solid #ddd; border-radius: 8px;box-shadow: 0 2px 4px rgba(0,0,0,0.1); box-sizing: border-box;
                height: 50%; background-color: aliceblue;'>
                <section class='title' style='background-color: white; border: 3px solid black; border-radius: 15px;'>
                  <h2>Event Title</h2>
                </section>
                <section class='bodysummary' style='background-color: bisque; border: 1px solid brown;'>
                  <p>Check out this event coming soon</p>
                </section>
                <section class='singleimage' style='overflow: hidden;'>
                  <img src='CSS/images/bb54289db635-screen-shot-2018-10-22-at-140657.png' alt='bb54289db635-screen-shot-2018-10-22-at-140657.png' 
                    style='max-width: 100%;'>
                </section>
                <section class='readmore'>
                  <a href=''><button class='morebutton' style='background-color: #0056b3; color: #ffffff; border: none; padding: 10px 20px;
                                border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: bold; transition: background-color 0.3s;'>READ MORE</button></a>
                </section>
              </section>
              <section class='eventpart left' style='display: flex; flex-direction: column; align-items: center; justify-content: space-between;
                padding: 2%; width: 100%; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                box-sizing: border-box; background-image: url(CSS/images/GettyImages-1085682140-1024x1024.jpg); background-size: 100% 100%;
                height: 25%; background-color: aliceblue;'>
                <section class='title' style='background-color: white; border: 3px solid black; border-radius: 15px;'>
                  <h2>Event Title</h2>
                </section>
                <section class='bodysummary' style='background-color: bisque; border: 1px solid brown;'>
                  <p>Check out this event coming soon</p>
                </section>
                <section class='readmore'>
                  <a href=''><button class='morebutton' style='background-color: #0056b3; color: #ffffff; border: none; padding: 10px 20px;
                                border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: bold; transition: background-color 0.3s;'>READ MORE</button></a>
                </section>
              </section>
              <section class='eventpart left' style='display: flex; flex-direction: column; align-items: center; justify-content: space-between;
                padding: 2%; width: 100%; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); box-sizing:
                border-box;background-image: url(CSS/images/jsonld.jpg); background-size: 100% 100%; height: 25%; background-color: aliceblue;'>
                <section class='title' style='background-color: white; border: 3px solid black; border-radius: 15px;'>
                  <h2>Event Title</h2>
                </section>
                <section class='bodysummary' style='background-color: bisque; border: 1px solid brown;'>
                  <p>Check out this event coming soon</p>
                </section>
                <section class='readmore'>
                  <a href=''><button class='morebutton' style='background-color: #0056b3; color: #ffffff; border: none; padding: 10px 20px;
                                border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: bold; transition: background-color 0.3s;'>READ MORE</button></a>
                </section>
              </section>
            </section>
            <section id='right'>
              <section class='eventpart right' style='display: flex; flex-direction: column; align-items: center; justify-content: space-between;
                padding: 2%; width: 100%; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                box-sizing: border-box; background-image: url(CSS/images/DSC06563-scaled.jpg); background-size: 100% 100%; height: 30%;
                background-color: aquamarine;'>
                <section class='title' style='background-color: white; border: 3px solid black; border-radius: 15px;'>
                  <h2>Event Title</h2>
                </section>
                <section class='bodysummary' style='background-color: bisque; border: 1px solid brown;'>
                  <p>Check out this event coming soon</p>
                </section>
                <section class='readmore'>
                  <a href=''><button class='morebutton' style='background-color: #0056b3; color: #ffffff; border: none; padding: 10px 20px;
                                border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: bold; transition: background-color 0.3s;'>READ MORE</button></a>
                </section>
              </section>
              <section class='eventpart right middle' style='display: flex; flex-direction: column; align-items: center; justify-content: space-between;
                padding: 2%; width: 100%; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                box-sizing: border-box; height: 40%; background-color: aquamarine;'>
                <section class='title' style='background-color: white; border: 3px solid black; border-radius: 15px;'>
                  <h2>Event Title</h2>
                </section>
                <section class='bodysummary' style='background-color: bisque; border: 1px solid brown;'>
                  <p>Check out this event coming soon</p>
                </section>
                <section class='singleimage' style='overflow: hidden;'>
                  <img src='CSS/images/happy-woman.jpg' alt='happy-woman.jpg' 
                    style='max-width: 100%;'>
                </section>
                <section class='readmore'>
                  <a href=''><button class='morebutton' style='background-color: #0056b3; color: #ffffff; border: none; padding: 10px 20px;
                                border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: bold; transition: background-color 0.3s;'>READ MORE</button></a>
                </section>
              </section>
              <section class='eventpart right' style='display: flex; flex-direction: column; align-items: center; justify-content: space-between;
                padding: 2%; width: 100%; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                box-sizing: border-box; background-image: url(CSS/images/lbfew_charity_2023_mojatu-071-1.jpg);
                background-size: 100% 100%; height: 30%; background-color: aquamarine;'>
                <section class='title' style='background-color: white; border: 3px solid black; border-radius: 15px;'>
                  <h2>Event Title</h2>
                </section>
                <section class='bodysummary' style='background-color: bisque; border: 1px solid brown;'>
                  <p>Check out this event coming soon</p>
                </section>
                <section class='readmore'>
                  <a href=''><button class='morebutton' style='background-color: #0056b3; color: #ffffff; border: none; padding: 10px 20px;
                                border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: bold; transition: background-color 0.3s;'>READ MORE</button></a>
                </section>
              </section>
            </section>
          </div>
        </div>";

    //Layout 2.
    $body2 = "<div id='emailbody' style='width: 60%; margin: auto; border: 2px solid black; padding: 2%; box-sizing: border-box;'>
                <div id='heading' style='text-align: center; margin-bottom: 40px;'>
                  <div id='logo'>
                    <img src='CSS/images/logo.png' alt='logo.png'>
                  </div>
                </div>
                <div id='navbar' style='padding: 5%;'>
                  <table style='border-bottom: 2px solid black; width: 100%;'>
                    <th><a href='' style='color: black; text-decoration: none;'>Therapy</a></th>
                    <th><a href='' style='color: black; text-decoration: none;'>Training</a></th>
                    <th><a href='' style='color: black; text-decoration: none;'>Events/Activities</a></th>
                  </table>
                </div>
                <div id='layout' style='display: flex; flex-flow: column wrap; justify-content: space-evenly; align-items: center;
                  padding: 5%;'>
                  <div id='poster' style='display: flex; padding: 2%; flex-flow: column wrap;'>
                    <img src='CSS/images/(1).png' alt='(1).png' style='max-width: 100%;'>
                  </div>
                  <div id='posterbody' style='width: 100%; justify-items: center;'>
                    <p>This is a really enlightening experience. You should check it out</p>
                  </div>
                  <div id='list' style='padding: 2%; display: flex; flex-wrap: wrap; justify-content: space-evenly; width: 100%;'>
                    <section class='eventpart' style='display: flex; flex-flow: column nowrap; align-items: center;
                      padding: 5%; width: 30%; border: 1px solid #ddd; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                      border-radius: 8px; box-sizing: border-box;'>
                      <section class='title'>
                          <h2>Event Title</h2>
                      </section>
                      <section class='bodysummary'>
                          <p>Check out this event coming soon</p>
                      </section>
                      <section class='singleimage'>
                          <img src='CSS/images/bb54289db635-screen-shot-2018-10-22-at-140657.png' alt='bb54289db635-screen-shot-2018-10-22-at-140657.png' 
                          style='max-width: 100%;'>
                      </section>
                      <section class='readmore'>
                          <a href=''><button class='morebutton' style='background-color: #0056b3; color: #ffffff; border: none; padding: 10px 20px;
                              border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: bold; transition: background-color 0.3s;'>READ MORE</button></a>
                      </section>
                    </section>
                    <section class='eventpart' style='display: flex; flex-flow: column nowrap; align-items: center; padding: 5%;
                      width: 30%; border: 1px solid #ddd; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border-radius: 8px;
                      box-sizing: border-box;'>
                      <section class='title'>
                          <h2>Event Title</h2>
                      </section>
                      <section class='bodysummary'>
                          <p>Check out this event coming soon</p>
                      </section>
                      <section class='singleimage'>
                          <img src='CSS/images/DSC06563-scaled.jpg' alt='DSC06563-scaled.jpg' 
                          style='max-width: 100%;'>
                      </section>
                      <section class='readmore'>
                          <a href=''><button class='morebutton' style='background-color: #0056b3; color: #ffffff; border: none;
                            padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: bold;
                            transition: background-color 0.3s;'>READ MORE</button></a>
                      </section>
                    </section>
                    <section class='eventpart' style='display: flex; flex-flow: column nowrap; align-items: center;
                      padding: 5%; width: 30%; border: 1px solid #ddd; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                      border-radius: 8px; box-sizing: border-box;'>
                      <section class='title'>
                          <h2>Event Title</h2>
                      </section>
                      <section class='bodysummary'>
                          <p>Check out this event coming soon</p>
                      </section>
                      <section class='singleimage'>
                          <img src='CSS/images/GettyImages-1085682140-1024x1024.jpg' alt='GettyImages-1085682140-1024x1024.jpg' 
                          style='max-width: 100%;'>
                      </section>
                      <section class='readmore'>
                          <a href=''><button class='morebutton' style='background-color: #0056b3; color: #ffffff; border: none;
                            padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: bold;
                            transition: background-color 0.3s;'>READ MORE</button></a>
                      </section>
                    </section>
                    <section class='eventpart' style='display: flex; flex-flow: column nowrap; align-items: center;
                      padding: 5%; width: 30%; border: 1px solid #ddd; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                      border-radius: 8px; box-sizing: border-box;'>
                      <section class='title'>
                          <h2>Event Title</h2>
                      </section>
                      <section class='bodysummary'>
                          <p>Check out this event coming soon</p>
                      </section>
                      <section class='singleimage'>
                          <img src='CSS/images/happy-woman.jpg' alt='happy-woman.jpg' 
                          style='max-width: 100%;'>
                      </section>
                      <section class='readmore'>
                          <a href=''><button class='morebutton' style='background-color: #0056b3; color: #ffffff;
                            border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: bold;
                            transition: background-color 0.3s;'>READ MORE</button></a>
                      </section>
                    </section>
                    <section class='eventpart' style='display: flex; flex-flow: column nowrap; align-items: center;
                      padding: 5%; width: 30%; border: 1px solid #ddd; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                      border-radius: 8px; box-sizing: border-box;'>
                      <section class='title'>
                          <h2>Event Title</h2>
                      </section>
                      <section class='bodysummary'>
                          <p>Check out this event coming soon</p>
                      </section>
                      <section class='singleimage'>
                          <img src='CSS/images/jsonld.jpg' alt='jsonld.jpg' 
                          style='max-width: 100%;'>
                      </section>
                      <section class='readmore'>
                          <a href=''><button class='morebutton' style='background-color: #0056b3; color: #ffffff;
                            border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 14px;
                            font-weight: bold; transition: background-color 0.3s;'>READ MORE</button></a>
                      </section>
                    </section>
                    <section class='eventpart' style='display: flex; flex-flow: column nowrap; align-items: center;
                      padding: 5%; width: 30%; border: 1px solid #ddd; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                      border-radius: 8px; box-sizing: border-box;'>
                      <section class='title'>
                          <h2>Event Title</h2>
                      </section>
                      <section class='bodysummary'>
                          <p>Check out this event coming soon</p>
                      </section>
                      <section class='singleimage'>
                          <img src='CSS/images/lbfew_charity_2023_mojatu-071-1.jpg' alt='CSS/images/lbfew_charity_2023_mojatu-071-1.jpg' 
                          style='max-width: 100%;'>
                      </section>
                      <section class='readmore'>
                          <a href=''><button class='morebutton' style='background-color: #0056b3; color: #ffffff;
                            border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-size: 14px;
                            font-weight: bold; transition: background-color 0.3s;'>READ MORE</button></a>
                      </section>
                    </section>
                  </div>
                </div>
              </div>";
    // Layout 3.
    $body3 = "<div id='emailbody' style='width: 80%; margin: auto; border: 2px solid black; padding: 2%; box-sizing: border-box;'>
                <div id='heading' style='display: flex; flex-flow: column nowrap; padding-left: 30%; padding-right: 30%;
                                align-items: center; max-height: fit-content;'>
                    <div id='logo'>
                      <img src='CSS/images/logo.png' alt='logo.png'>
                    </div>
                    <h1>See what is coming soon</h1>
                </div>
                <div id='layout' style='display: flex; flex-wrap: wrap; justify-content: space-evenly; padding-left: 3%;
                                padding-right: 3%; width: 100%;'>
                    <section class='eventpart' style='display: flex; flex-flow: column nowrap; align-items: center; padding: 5%;
                                    width: 40%; border: 1px solid #ddd; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                    border-radius: 8px; box-sizing: border-box;'>
                    <section class='title'>
                        <h2>Event Title</h2>
                    </section>
                    <section class='bodysummary'>
                        <p>Check out this event coming soon</p>
                    </section>
                    <section class='singleimage'>
                        <img src='CSS/images/bb54289db635-screen-shot-2018-10-22-at-140657.png' alt='bb54289db635-screen-shot-2018-10-22-at-140657.png' 
                        style='max-width: 100%;'>
                    </section>
                    <section class='readmore'>
                        <a href=''><button class='morebutton' style='background-color: #0056b3; color: #ffffff; border: none; padding: 10px 20px;
                                border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: bold; transition: background-color 0.3s;'>READ MORE</button></a>
                    </section>
                    </section>
                    <section class='eventpart' style='display: flex; flex-flow: column nowrap; align-items: center; padding: 5%;
                                    width: 40%; border: 1px solid #ddd; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                    border-radius: 8px; box-sizing: border-box;'>
                    <section class='title'>
                        <h2>Event Title</h2>
                    </section>
                    <section class='bodysummary'>
                        <p>Check out this event coming soon</p>
                    </section>
                    <section class='singleimage'>
                        <img src='CSS/images/DSC06563-scaled.jpg' alt='DSC06563-scaled.jpg' 
                        style='max-width: 100%;'>
                    </section>
                    <section class='readmore'>
                        <a href=''><button class='morebutton' style='background-color: #0056b3; color: #ffffff; border: none; padding: 10px 20px;
                                border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: bold; transition: background-color 0.3s;'>READ MORE</button></a>
                    </section>
                    </section>
                    <section class='eventpart' style='display: flex; flex-flow: column nowrap; align-items: center; padding: 5%;
                                    width: 40%; border: 1px solid #ddd; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                    border-radius: 8px; box-sizing: border-box;'>
                    <section class='title'>
                        <h2>Event Title</h2>
                    </section>
                    <section class='bodysummary'>
                        <p>Check out this event coming soon</p>
                    </section>
                    <section class='singleimage'>
                        <img src='CSS/images/GettyImages-1085682140-1024x1024.jpg' alt='GettyImages-1085682140-1024x1024.jpg' 
                        style='max-width: 100%;'>
                    </section>
                    <section class='readmore'>
                        <a href=''><button class='morebutton' style='background-color: #0056b3; color: #ffffff; border: none; padding: 10px 20px;
                                border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: bold; transition: background-color 0.3s;'>READ MORE</button></a>
                    </section>
                    </section>
                    <section class='eventpart' style='display: flex; flex-flow: column nowrap; align-items: center; padding: 5%;
                                    width: 40%; border: 1px solid #ddd; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                    border-radius: 8px; box-sizing: border-box;'>
                    <section class='title'>
                        <h2>Event Title</h2>
                    </section>
                    <section class='bodysummary'>
                        <p>Check out this event coming soon</p>
                    </section>
                    <section class='singleimage'>
                        <img src='CSS/images/happy-woman.jpg' alt='happy-woman.jpg' 
                        style='max-width: 100%;'>
                    </section>
                    <section class='readmore'>
                        <a href=''><button class='morebutton' style='background-color: #0056b3; color: #ffffff; border: none; padding: 10px 20px;
                                border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: bold; transition: background-color 0.3s;'>READ MORE</button></a>
                    </section>
                    </section>
                    <section class='eventpart' style='display: flex; flex-flow: column nowrap; align-items: center; padding: 5%;
                                    width: 40%; border: 1px solid #ddd; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                    border-radius: 8px; box-sizing: border-box;'>
                    <section class='title'>
                        <h2>Event Title</h2>
                    </section>
                    <section class='bodysummary'>
                        <p>Check out this event coming soon</p>
                    </section>
                    <section class='singleimage'>
                        <img src='CSS/images/jsonld.jpg' alt='jsonld.jpg' 
                        style='max-width: 100%;'>
                    </section>
                    <section class='readmore'>
                        <a href=''><button class='morebutton' style='background-color: #0056b3; color: #ffffff; border: none; padding: 10px 20px;
                                border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: bold; transition: background-color 0.3s;'>READ MORE</button></a>
                    </section>
                    </section>
                    <section class='eventpart' style='display: flex; flex-flow: column nowrap; align-items: center; padding: 5%;
                                    width: 40%; border: 1px solid #ddd; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                    border-radius: 8px; box-sizing: border-box;'>
                    <section class='title'>
                        <h2>Event Title</h2>
                    </section>
                    <section class='bodysummary'>
                        <p>Check out this event coming soon</p>
                    </section>
                    <section class='singleimage'>
                        <img src='CSS/images/lbfew_charity_2023_mojatu-071-1.jpg' alt='CSS/images/lbfew_charity_2023_mojatu-071-1.jpg' 
                        style='max-width: 100%;'>
                    </section>
                    <section class='readmore'>
                        <a href=''><button class='morebutton' style='background-color: #0056b3; color: #ffffff; border: none; padding: 10px 20px;
                                border-radius: 4px; cursor: pointer; font-size: 14px; font-weight: bold; transition: background-color 0.3s;'>READ MORE</button></a>
                    </section>
                    </section>
                </div>
                </div>";
    //Layout 4.
    $body4 = "<div id='emailbody' style='width: 40%; margin: auto; border: 2px solid black; padding: 2%; box-sizing: border-box;'>
                <div id='heading' style='text-align: center; margin-bottom: 40px;'>
                  <div id='logo'>
                    <img src='CSS/images/logo.png' alt='logo.png'>
                  </div>
                </div>
                <div id='promonavbar' style='padding: 5%;'>
                  <table style='border-bottom: 2px solid black; width: 100%;'>
                    <th><a href='' style='color: black; text-decoration: none;'>Therapy</a></th>
                    <th><a href='' style='color: black; text-decoration: none;'>Training</a></th>
                    <th><a href='' style='color: black; text-decoration: none;'>Events/Activities</a></th>
                  </table>
                </div>
                <div id='layout' style='display: flex; flex-flow: column wrap; justify-content: space-evenly; align-items: center;
                  padding: 5%;'>
                  <div id='poster1' style='display: flex; padding: 2%; flex-flow: column wrap;'>
                    <img src='CSS/images/(1).png' alt='(1).png' style='max-width: 100%;'>
                  </div>
                  <div id='posterbody' style='width: 100%; justify-items: center;'>
                    <p>This is a really enlightening experience. You should check it out</p>
                  </div>
                  <div id='poster2' style='display: flex; padding: 2%; flex-flow: column wrap; align-items: center;'>
                    <img src='CSS/images/lbfew_charity_2023_mojatu-071-1.jpg' alt='lbfew_charity_2023_mojatu-071-1.jpg' style='max-width: 80%;'>
                  </div>
                  <div id='services' style='display: flex; flex-flow: column wrap; align-items: center;'>
                    <h3>Other Services</h3>
                    <table style='border-collapse: collapse;'><tr>
                        <th style='border-right: 1px solid #000; padding: 8px;'><a href='https://womensconsortium.org.uk/therapy/' style='color: black; text-decoration: none;'>Therapy</a></th>
                        <th style='border-right: 1px solid #000; padding: 8px;'><a href='https://womensconsortium.org.uk/training/' style='color: black; text-decoration: none;'>Training</a></th>
                        <th style='padding: 8px;'><a href='https://womensconsortium.org.uk/events/' style='color: black; text-decoration: none;'>Events/Activities</a></th>
                      </tr>
                      <tr>
                        <td style='border-right: 1px solid #000; padding: 8px;'><a href='https://womensconsortium.org.uk/therapy/counselling/' style='color: black; text-decoration: none;'>Counselling</a></td>
                        <td style='border-right: 1px solid #000; padding: 8px;'><a href='https://womensconsortium.org.uk/workshops/' style='color: black; text-decoration: none;'>Workshops</a></td>
                        <td style='padding: 8px;'><a href='https://womensconsortium.org.uk/resources/' style='color: black; text-decoration: none;'>Resources</a></td>
                      </tr>
                      <tr>
                        <td style='border-right: 1px solid #000; padding: 8px;'><a href='https://womensconsortium.org.uk/therapy/neuro-linguistic-programming-nlp/' style='color: black; text-decoration: none;'>NLP</a></td>
                        <td style='border-right: 1px solid #000; padding: 8px;'><a href='https://womensconsortium.org.uk/past-training-customers/' style='color: black; text-decoration: none;'>Connected Organisations</a></td>
                        <td style='padding: 8px;'></td>
                      </tr>
                      <tr>
                        <td style='border-right: 1px solid #000; padding: 8px;'><a href='https://womensconsortium.org.uk/therapy/mediation/' style='color: black; text-decoration: none;'>Mediation</a></td>
                        <td style='border-right: 1px solid #000; padding: 8px;'></td>
                        <td style='padding: 8px;'></td>
                      </tr>
                      <tr>
                        <td style='border-right: 1px solid #000; padding: 8px;'><a href='https://womensconsortium.org.uk/therapy/personal-development-program-pdp/' style='color: black; text-decoration: none;'>PDP</a></td>
                        <td style='border-right: 1px solid #000; padding: 8px;'></td>
                        <td style='padding: 8px;'></td>
                      </tr>
                      <tr>
                        <td style='border-right: 1px solid #000; padding: 8px;'><a href='https://womensconsortium.org.uk/therapy/family-and-couple-counselling/' style='color: black; text-decoration: none;'>Couples/Family Counselling</a></td>
                        <td style='border-right: 1px solid #000; padding: 8px;'></td>
                        <td style='padding: 8px;'></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>";

?>