<!-- <template>
    <div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-xl-3 ">
                    <div slot="front">
                        <div class="widget-bg-color-icon card-box">
                            <div class="bg-icon float-left">
                                <i class="ti-eye text-warning"></i>
                            </div>
                            <div class="text-right">
                                <h3 class="text-dark"><b>3752</b></h3>
                                <p>Daily Visits</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xl-3">
                    <div slot="front">
                        <div class="widget-bg-color-icon card-box">
                            <div class="bg-icon float-left">
                                <i class="ti-shopping-cart text-success"></i>
                            </div>
                            <div class="text-right">
                                <h3><b id="widget_count3">3251</b></h3>
                                <p>Sales status</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
            </div>

            <div class="col-sm-6 col-md-6 col-xl-3">
                    <div slot="front">
                        <div class="widget-bg-color-icon card-box">
                            <div class="bg-icon float-left">
                                <i class="ti-thumb-up text-danger"></i>
                            </div>
                            <div class="text-right">
                                <h3 class="text-dark"><b>1532</b></h3>
                                <p>Hits</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xl-3">
                    <div slot="front">
                        <div class="widget-bg-color-icon card-box">
                            <div class="bg-icon float-left">
                                <i class="ti-user text-info"></i>
                            </div>
                            <div class="text-right">
                                <h3 class="text-dark"><b>1252</b></h3>
                                <p>Subscribers</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 col-12">
                <div class="row">
                    <div class="col-sm-12">
                        <b-card no-body class="main-chart">
                            <b-tabs ref="tabs" card>
                                <b-tab title="Live Feed" active>
                                    <div class="form-group text-right">
                                        <input type="checkbox" id="toggle_real" name="my-checkbox"
                                               data-size="small" class="float-right" checked>
                                    </div>
                                    <div id="live-chart" class="livechart-tab1 m-t-10"></div>
                                </b-tab>
                            </b-tabs>
                        </b-card>
                    </div>
                    <div class="col-sm-5">
                        <newsfeed></newsfeed>
                    </div>
                    <div class="col-sm-7">
                        <div class="card real-timechart">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 text-center">
                                        <h3 class="">Real-Time Visits</h3>
                                        <div class="real-value"><p><span></span>k</p></div>
                                    </div>
                                    <div class="col-6 text-center">
                                        <h3 class="">Returning Visitors</h3>
                                        <div class="return-value"><p><span></span>k</p></div>
                                    </div>
                                </div>
                                <div id="realtime-views" class="real-chart"></div>
                                <hr>
                                <div class="row ratings">
                                    <div class="col-4 text-center">
                                        <h4>81%</h4>
                                        <p>Satisfied</p>
                                    </div>
                                    <div class="col-4 text-center">
                                        <h4>8%</h4>
                                        <p>Unsatisfied</p>
                                    </div>
                                    <div class="col-4 text-center">
                                        <h4>11%</h4>
                                        <p>NA</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 ">
                        <project_status></project_status>
                    </div>
                </div>
            </div>
            <div class="col-xl-4  col-12">
                <div class="row">
                    <div class="col-xl-12 col-sm-6 col-lg-6">
                        <timeline></timeline>
                    </div>
                    <div class="col-xl-12 col-lg-6 col-sm-6">
                        <chat></chat>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue'
    var spark_time
    const moment = require("moment");
    import sparkline from "../../assets/js/custom_js/sparkline/jquery.flot.spline.js";
    import lc_switch from "../../vendors/LC-switch/lc_switch.min.js";
    import flot from "../../vendors/flotchart/jquery.flot.js";
    import flotresize from "../../assets/js/jquery.flot.resize.js";
    import flotstack from "../../vendors/flotchart/jquery.flot.stack.js";
    import flotspline from "../../vendors/flot-spline/js/jquery.flot.spline.min.js";
    import flottooltip from "../../vendors/flot.tooltip/js/jquery.flot.tooltip.min.js";

    //    new
    import chat from "./dashboard/dashboard_one/chat.vue"
    import newsfeed from "./dashboard/dashboard_one/newsfeed.vue"
    import timeline from "./dashboard/dashboard_one/timeline.vue"
    import project_status from "./dashboard/dashboard_one/project_status.vue"
    export default {
        name: 'index',
        components:{
            chat,newsfeed,timeline,project_status
        },
        data() {
            return {
                bar_color: "#ccc",
                height: "300px",
                bar_width: "10px",
                visible: false,
            }
        },
        mounted: function() {
            "use strict"
            $(document).ready(function() {
                // tab-1
                $('#toggle_real').lc_switch();

                /* server load  */
                var data_1 = [],
                    totalPoints_1 = 70;

                function getRandomData_1() {
                    if (data_1.length > 0)
                        data_1 = data_1.slice(1);
                    // do a random walk
                    while (data_1.length < totalPoints_1) {
                        var prev_1 = data_1.length > 0 ? data_1[data_1.length - 1] : 50;
                        var y = prev_1 + Math.random() * 10 - 5;
                        if (y < 25)
                            y = 30;
                        if (y > 100)
                            y = 90;
                        data_1.push(y);
                    }
                    // zip the generated y values with the x values
                    var res_1 = [];
                    for (var i = 0; i < data_1.length; ++i)
                        res_1.push([i, data_1[i]])
                    return res_1;
                }

                // setup control widget
                var updateInterval_1 = 1000;

                // setup plot
                var options_1 = {
                    colors: ["linear-gradient(70deg, #36A0F1 0, #b097cf 100%)"],

                    series: {
                        shadowSize: 0,
                        lines: {
                            show: true,
                            fill: true,
                            fillColor: {
                                colors: [{
                                    opacity: 0.3
                                }, {
                                    opacity: 0.3
                                }]
                            }
                        }
                    },
                    yaxis: {
                        min: 0,
                        max: 120
                    },
                    xaxis: {
                        show: false
                    },
                    grid: {
                        backgroundColor: '#fff',
                        borderWidth: 1,
                        borderColor: '#fff'
                    }
                };

                var plot_1 = $.plot($("#live-chart"), [getRandomData_1()], options_1);

                function update_1() {
                    plot_1.setData([getRandomData_1()]);
                    // since the axes don't change, we don't need to call plot.setupGrid()
                    plot_1.draw();
                    if ($("#toggle_real").prop("checked")) {
                        setTimeout(update_1, updateInterval_1);
                    }
                }

                update_1();

                $('#toggle_real').on('lcs-statuschange', function() {
                    update_1();
                });
                //tab-1 ends

                //tab-2

                //start line chart

                // real time flot chart

                var gen_val = [],
                    totalPoints = 60;
                var updateInterval = 500;

                function getRandomData() {

                    if (gen_val.length > 0)
                        gen_val = gen_val.slice(1);

                    // Do a random walk

                    while (gen_val.length < totalPoints) {

                        var prev = gen_val.length > 0 ? gen_val[gen_val.length - 1] : 25,
                            y = (Math.random() * 40) + 10;

                        if (y < 0) {
                            y = 0;
                        } else if (y > 49) {
                            y = 49;
                        }

                        gen_val.push(y);
                        $('.real-value span').html(Math.round(y));

                        var z = (Math.random() * 5) + 4;
                        $('.return-value span').html(Math.round(z));
                    }

                    // Parsing the generated y values with the x values

                    var res = [];
                    for (var i = 0; i < gen_val.length; ++i) {
                        res.push([i, gen_val[i]])
                    }

                    return res;
                }

                var plot = $.plot("#realtime-views", [getRandomData()], {
                    series: {
                        bars: {
                            show: true,
                            lineWidth: 0,
                            barWidth: 0.8,
                            fill: 0.35
                        },
                        shadowSize: 0
                    },
                    grid: {
                        labelMargin: 8,
                        hoverable: true,
                        clickable: true,
                        borderWidth: 0,
                        borderColor: '#f5f5f5'
                    },
                    yaxis: {
                        min: 0,
                        max: 50,
                        ticks: [0, 25, 50],
                        tickColor: '#f5f5f5',
                        font: {
                            color: '#bdbdbd',
                            size: 12
                        }
                    },
                    xaxis: {
                        show: false
                    },
                    colors: ['#00bcd4'],
                    tooltip: true,
                    tooltipOpts: {
                        content: "Active User: %y"
                    }

                });

                function update() {

                    plot.setData([getRandomData()]);
                    plot.draw();
                    setTimeout(update, updateInterval);
                }

                update();
                // real time chart ends


            });
        },
        destroyed: function() {
            window.clearTimeout(spark_time);
        }
    }
</script>
<style src="../../vendors/LC-switch/lc_switch.css"></style>
<style src="../../assets/css/custom_css/dashboard1.css"></style> -->