@include('header');


<style>

    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #4CAF50;
    }

    /* Style the buttons that are used to open the tab content */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        /*display: none;*/
        padding: 6px 12px;
        /*border: 1px solid #ccc;*/
        border-top: none;
        animation: fadeEffect 1s; /* Fading effect takes 1 second */
    }

    /* Go from zero to full opacity */
    @keyframes fadeEffect {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }


    .event-container {
        padding: 20px;
        color: #ffffff;
    }

    .event-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .event-details {
        margin-bottom: 20px;
    }

    .time-slots {
        margin-top: 20px;
    }

    .time-slot {
        margin-bottom: 10px;
    }

    .time-slot label {
        margin-left: 10px;
    }

    .select-button {
        display: block;
        margin: 20px auto;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    .select-button:hover {
        background-color: #45a049;
    }

    .stalls-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .stalls-table th, .stalls-table td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .stalls-table th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }

    .stalls-table td {
        color: white;
    }

    .selected-timeslot-count {
        background-color: darkred;
        color: white;
        padding: 5px;
        border-radius: 50%;
        margin-right: 10px;

    }
</style>

<!-- Initialize AngularJS app -->
<section class="home" id="app">



    <div class="content event-container">

        @if($event->image != '')
            <div>
                <img src="http://fyp-diploma.test/images/{{ $event->image }}" alt="Event Image"
                     style="width: 100%; height: 300px; object-fit: cover;">
            </div>
        @endif

        <div class="event-header">
            <h1>{{ $event->name }}</h1>
        </div>
        <div class="event-details">
            <p>{{ $event->detail }}</p>
        </div>


        <div class="time-slots">
            <h2>Time Slots</h2>


            <!-- Tab links -->
            <div class="tab">
                <button
                    v-for="(timeSlot, index) in timeSlots"
                    :key="index"
                    :class="['tablinks', { active: selectedTimeSlot === timeSlot.time_slot_id }]"
                    @click="switchTimeSlotTab(timeSlot.time_slot_id)">

                    <span class="selected-timeslot-count" v-show="timeSlot.count > 0">

                    </span>

                    <span>
                        @{{ customDateFormat(timeSlot.date_from) }} @{{timeSlot.time_from}}
                        <br> - </br>
                        @{{ customDateFormat(timeSlot.date_to) }} @{{timeSlot.time_to}}
                    </span>

                </button>
            </div>

            <!-- Tab content -->
            <div v-for="timeSlot in timeSlots" :key="timeSlot.time_slot_id" :id="timeSlot.time_slot_id"
                 v-show="selectedTimeSlot === timeSlot.time_slot_id"
                 class="tabcontent">


                <div class="row">
                    <h2>Stalls</h2>
                    <table class="stalls-table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Stall Name</th>
                            <th>Category</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>


                        <tr v-for="(stall, index) in displayStalls" :key="stall.stall_id">
                            <td>
                                <input type="checkbox" @click="selectStall(stall.stall_id, stall.price)" v-show="stall.status != 1"   :checked="isStallSelected(stall.stall_id, stall.time_slot_id)">
                                <span v-show="stall.status == 1" style="color: red">Booked</span>
                            </td>
                            <td>@{{ stall.stall_type }}@{{ stall.stall_count }}</td>
                            <td>@{{ stall.category }}</td>
                            <td>RM @{{ stall.price }}</td>
                        </tr>
                        <tr>
                            <td>Total: (@{{ totalCount }})</td>
                            <td colspan="3">RM @{{ total }}</td>
                        </tr>
                        </tbody>
                    </table>

                </div>

            </div>

            <div style="text-align: center;" v-show="totalCount > 0">
                <button type="button" class="select-button" @click.prevent="makePayment">Make Payment</button>
            </div>

        </div>


    </div>
</section>

<script>
    const {createApp} = Vue

    createApp({
        data() {
            return {
                eventId: '{{ $event->id }}',
                selectedStallList: [],
                selectedTimeSlot: '',
                timeSlots: [],
                displayStalls: [],
                stalls: [],
                totalCount: 0,
                total: 0,
            }
        },
        mounted() {
            this.getData();
        },
        methods: {
            selectStall(stallId, price) {
                //selectedStallList object => {stallId: 1, timeSlotId: 1}
                //If the stall is already selected with same timeslotId, remove it from the list
                //Else add it to the list
                const stallIndex = this.selectedStallList.findIndex(stall => stall.stallId === stallId && stall.timeSlotId === this.selectedTimeSlot);
                if (stallIndex > -1) {
                    this.selectedStallList.splice(stallIndex, 1);
                    this.totalCount--;
                    this.total -= parseFloat(price);
                } else {
                    this.selectedStallList.push({stallId: stallId, timeSlotId: this.selectedTimeSlot, price: price});
                    this.totalCount++;
                    this.total += parseFloat(price);
                }


            },
            isStallSelected(stallId, timeSlotId) {
                return this.selectedStallList.some(stall => stall.stallId === stallId && stall.timeSlotId === timeSlotId);
            },

            customDateFormat(dateString) {
                return new Date(dateString).toLocaleDateString('en-GB', {
                    day: 'numeric', month: 'short', year: 'numeric'
                });
            },

            switchTimeSlotTab(timeSlotId) {
                this.selectedTimeSlot = timeSlotId;
                this.displayStalls = this.stalls.filter(stall => stall.time_slot_id === this.selectedTimeSlot);
                console.log(this.selectedTimeSlot);

            },
            getData(){
                fetch("{{ route('event-data', ['id' => $event->id]) }}")
                    .then(response => response.json())
                    .then(data => {
                        this.timeSlots = data.timeSlots;
                        this.stalls = data.stalls;

                        if (this.timeSlots.length > 0) {
                            this.selectedTimeSlot = this.timeSlots[0].time_slot_id;
                            this.displayStalls = this.stalls.filter(stall => stall.time_slot_id === this.selectedTimeSlot);


                        }

                    });
            },


            makePayment() {
                // Handle payment logic

                fetch("{{ route('make-payment') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        _token: '{{ csrf_token() }}',
                        eventId: this.eventId,
                        selectedStall: this.selectedStallList,
                    }),
                })
                    .then(response => {
                        // 检查响应状态是否成功
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        // 将响应体解析为JSON
                        return response.text();
                    })
                    .then(data => {
                        // 在这里处理服务器返回的数据
                        console.log('Success:', data);

                        // Redirect to payment page
                        window.location.href = data;
                    })
                    .catch(error => {
                        // 处理错误
                        console.error('Error:', error);
                        alert('An error occurred: ' + error.message);
                    });
            }
        },
    }).mount('#app')
</script>


@include('footer');
