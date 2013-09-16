<style>
    #ffs-score-input{
        padding-top: 20Px;
        padding-bottom: 20Px;
        font-size: 18Pt;
        width: 50%;
    }
    .ffs-number-pad{
        width:32%;
        display:inline-block;
    }
    .ffs-number-pad a{
        width:57%;
        height:45Px;
        font-size:22Pt;
        padding-top:25Px;
    }
    #myTab >li>a{
        font-size: 18Pt
    }
    .tab-pane .row-fluid{
        margin-bottom:10Px;
    }
    .ffs-score-notes{
        width:
    }
    #ffs-special-notes > .btn{
        padding-top: 10Px;
        padding-bottom: 10Px;
        font-size: 13Pt;
    }
</style>
<div class='container'>
    <div class='row'>
        <div class='span12'>
            <div class='well'>
                <div class='pull-left'>
                    <h3>Athlete Name:</h3>
                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                            Brianna Slonim
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href=''>
                                    Chelsie Gray
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class='pull-right'>
                    <h3>AA</h3>
                    <div style='font-size:30Pt'>
                        33.525
                    </div>
                </div>
                <div style='clear:both'></div>
            </div>
        </div>
    </div>

    <div class='row'>
        <div class='span12'>
            <div class="" style='margin-top:100Px;'>
                <ul id="myTab" class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab">Vault</a></li>
                    <li><a href="#home" data-toggle="tab">Bars</a></li>
                    <li><a href="#home" data-toggle="tab">Beam</a></li>
                    <li><a href="#home" data-toggle="tab">Floor</a></li>
                   <!-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Options <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#dropdown1" data-toggle="tab">@fat</a></li>
                            <li><a href="#dropdown2" data-toggle="tab">@mdo</a></li>
                        </ul>
                    </li>-->
                </ul>
                <div id="myTabContent" class="tab-content" style='overflow: hidden'>
                    <div class="tab-pane fade in active" id="home">
                        <div class='container-fluid'>
                            <div class='row-fluid'>
                                <div class='span12'>
                                    <div class='input-append'>
                                        <input id='ffs-score-input' type='text' class='input-large ffs-score-input' value='9.1' />
                                        <div id='ffs-special-notes' class="btn-group">
                                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                                Special Notes:
                                                <span class="caret"></span>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href='#'>
                                                       Solid
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href='#'>
                                                        Averedge
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href='#'>
                                                        Wobbly
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href='#'>
                                                        Fall
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class='row-fluid'>
                                <div class='span12'>
                                    <div class='width:90%'>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large' href='#'>
                                                1
                                            </a>
                                        </div>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large'  href='#'>
                                                2
                                            </a>
                                        </div>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large' href='#'>
                                                3
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='row-fluid'>
                                <div class='span12'>
                                    <div class='width:90%'>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large' href='#'>
                                                4
                                            </a>
                                        </div>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large'  href='#'>
                                                5
                                            </a>
                                        </div>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large' href='#'>
                                                6
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='row-fluid'>
                                <div class='span12'>
                                    <div class='width:90%'>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large' href='#'>
                                                7
                                            </a>
                                        </div>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large'  href='#'>
                                                8
                                            </a>
                                        </div>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large' href='#'>
                                                9
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='row-fluid'>
                                <div class='span12'>
                                    <div class='width:90%'>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large' href='#'>
                                                <i class=' icon-arrow-lef'></i>
                                                <i class=' icon-remove'></i>
                                            </a>
                                        </div>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large'  href='#'>
                                                0
                                            </a>
                                        </div>
                                        <div class='ffs-number-pad'>
                                            <a class='btn btn-large' href='#'>
                                                Enter
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='row-fluid'>
                                <div class='span4'>
                                    <label>Start Value:</label>
                                    <input id='ffs-start-value-input' type='text' class='input-large' value='10' />
                                </div>
                                <div class='span4'>
                                    <label>Place:</label>
                                    <div class='alert alert-info'>
                                        <select>
                                            <option></option>
                                            <option>1st</option>
                                            <option>2nd</option>
                                            <option>3rd</option>
                                            <option>4th</option>
                                            <option>5th</option>
                                            <option>...</option>
                                        </select>
&nbsp;&nbsp;&nbsp;
                                        <span>
                                            Tie:
                                        </span>
                                        <input type='checkbox' />
                                    </div>
                                </div>
                               
                            </div>
                            <div class='row-fluid'>

                                <textarea class='span12 ffs-score-notes' placeholder="notes"></textarea>

                            </div>

                        </div>

                    </div>
                    <div class="tab-pane fade" id="profile">

                    </div>
                    <div class="tab-pane fade" id="dropdown1">

                    </div>
                    <div class="tab-pane fade" id="dropdown2">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>