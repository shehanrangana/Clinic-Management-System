<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simple Calendar on vuejs, moment.js, bootstrap 4 and fontawesome</title>
</head>

<body>
    <div id="app">
        <b-container>
            <div class="b-calendar">
                <b-row>
                    <b-col md="4">
                        <div class="b-calendar__information">
                            <div class="today d-flex justify-content-center align-items-center">
                                <div class="weekDay">
                                    {{selectedWeekDay | capitalize}}
                                </div>
                                <div class="day">
                                    {{selectedDayAndMonth.day}}
                                </div>
                                <div class="month">
                                    {{selectedDayAndMonth.month | capitalize}}
                                </div>
                                <a href="#" id="goTodayLink" @click="goToday" v-show="!todayInCurrentMonthAndYear || !todayIsEqualSelectDate">
                                    Today
                                </a>
                                <b-tooltip target="goTodayLink" v-show="!todayInCurrentMonthAndYear || !todayIsEqualSelectDate">
                                    Back to today
                                </b-tooltip>
                            </div>
                        </div>
                    </b-col>
                    <b-col md="8">
                        <div class="b-calendar__calendar">
                            <div class="b-calendar__header">
                                <b-row>
                                    <b-col class="year text-right" align-h="end">
                                        <span>{{year}}</span>
                                    </b-col>
                                </b-row>
                                <b-row align-v="center">
                                    <b-col class="text-left" align-h="start">
                                        <b-button id="subtractMonthBtn" class="arrow arrow-left" variant="light" @click="subtractMonth">
                                            <i class="fa fa-fw fa-chevron-left"></i>
                                        </b-button>
                                        <b-tooltip target="subtractMonthBtn">
                                            {{previousMonthAsString | capitalize}}
                                        </b-tooltip>
                                    </b-col>
                                    <b-col class="text-center" align-h="center">
                                        <span class="month">{{month}}</span>
                                    </b-col>
                                    <b-col class="text-right d-flex flex-row-reverse" align-h="end">
                                        <b-button id="addMonthBtn" class="arrow arrow-right" variant="light" @click="addMonth">
                                            <i class="fa fa-fw fa-chevron-right"></i>
                                        </b-button>
                                        <b-tooltip target="addMonthBtn">
                                            {{nextMonthAsString | capitalize}}
                                        </b-tooltip>
                                    </b-col>
                                </b-row>
                            </div>
                            <div class="b-calendar__weekdays">
                                <div class="weekday" v-for="(day, index) in days" :key="index">
                                    <strong>{{day}}</strong>
                                </div>
                            </div>
                            <div class="b-calendar__dates">
                                <div class="date text-right" :class="{
                                'today': date.today,
                                'blank': date.blank,
                                'no-border-right': date.key % 7 === 0,
                             }"
                                    v-for="date in dateList" :key="date.key" :data-date="date.date" @click="setSelectedDate(date.moment)">
                                    <span class="day">{{date.dayNumber}}</span>
                                    <span class="weekday">{{date.weekDay}}</span>
                                    <div class="additional" v-show="date.additional">
                                        <span class="year" v-show="date.additional.year">{{date.additional.year}}</span>
                                        <span class="month" v-show="date.additional.month">{{date.additional.month}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </b-col>
                </b-row>
            </div>
        </b-container>
    </div>
    <script type="text/javascript" src="/js/app.js"></script>
</body>

</html>