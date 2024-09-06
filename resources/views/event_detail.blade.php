@include('header');


<style>

    /* Style the tab */
    .tab {
        overflow: hidden;
        border-bottom: 2px solid #555;
        background-color: #1e3a8a; /* Darker, more vibrant background */
        border-radius: 10px 10px 0 0; /* Rounded top corners for a modern look */
    }

    /* Style the buttons that are used to open the tab content */
    .tab button {
        background-color: #3b82f6; /* Brighter blue for better contrast */
        color: white;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 20px;
        transition: background-color 0.3s, color 0.3s, transform 0.2s; /* Smooth transitions */
        border-radius: 10px 10px 0 0; /* Match tab container's rounded corners */
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #2563eb; /* Slightly darker blue on hover */
        color: #e0f2fe;
        transform: translateY(-2px); /* Slight elevation effect */
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #1e40af; /* Even darker blue for active tab */
        color: #e0f2fe; /* Lighter text color for better readability */
    }

    /* Style the tab content */
    .tabcontent {
        padding: 20px;
        border: 1px solid #555;
        border-top: none;
        animation: fadeEffect 0.8s;
        background-color: #f1f5f9; /* Light background for content */
        color: #1e293b; /* Darker text color for readability */
        border-radius: 0 0 10px 10px; /* Rounded bottom corners */
    }

    /* Go from zero to full opacity */
    @keyframes fadeEffect {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .event-container {
        padding: 25px;
        color: #1e293b; /* Darker text color for event details */
        background-color: #e2e8f0; /* Light gray background for contrast */
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    }

    .event-header {
        text-align: center;
        margin-bottom: 25px;
        font-size: 28px;
        font-weight: bold;
        color: #1e3a8a; /* Match primary color */
    }

    .event-details {
        margin-bottom: 25px;
        font-size: 18px;
        line-height: 1.7;
        color: #334155; /* Slightly darker for detail text */
    }

    .time-slots {
        margin-top: 30px;
    }

    .time-slot {
        margin-bottom: 20px;
    }

    .time-slot label {
        margin-left: 10px;
        color: #1e293b;
        font-weight: bold; /* Make labels stand out */
    }

    .select-button {
        display: block;
        margin: 30px auto;
        padding: 14px 28px;
        background-color: #10b981; /* Bright green for action button */
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 10px;
        font-size: 18px;
        transition: background-color 0.3s, transform 0.2s; /* Smooth transitions */
    }

    .select-button:hover {
        background-color: #059669; /* Darker green on hover */
        transform: translateY(-2px); /* Slight elevation effect */
    }

    .stalls-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 35px;
        background-color: #e2e8f0; /* Light gray background for tables */
        color: #1e293b;
        border-radius: 10px;
        overflow: hidden; /* Ensure rounded corners */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    }

    .stalls-table th, .stalls-table td {
        border: 1px solid #cbd5e1; /* Light border color */
        padding: 14px;
        text-align: center;
    }

    .stalls-table th {
        background-color: #3b82f6; /* Match primary color */
        color: white;
        font-weight: bold;
    }

    .selected-timeslot-count {
        background-color: #ef4444; /* Bright red for alert */
        color: white;
        padding: 5px 12px;
        border-radius: 50%;
        margin-right: 10px;
        font-size: 16px; /* Slightly larger for emphasis */
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
                                <input type="checkbox" @click="selectStall(stall.stall_id, stall.price)"
                                       v-show="stall.status != 1"
                                       :checked="isStallSelected(stall.stall_id, stall.time_slot_id)">
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

                <button type="button" class="select-button" @click.prevent="makePayment" v-if="!isMakePaymentClicked">
                    Make Payment
                </button>
                <button type="button" class="select-button" v-else>Loading</button>
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
                isLoggedIn: false,
                isMakePaymentClicked: false
            }
        },
        mounted() {
            this.getData();
            this.checkLoginStatus();

            // 恢复选择的数据
            const savedStallList = localStorage.getItem('selectedStallList');
            const savedTimeSlot = localStorage.getItem('selectedTimeSlot');
            const savedTotalCount = localStorage.getItem('totalCount');
            const savedTotal = localStorage.getItem('total');

            if (savedStallList) {
                this.selectedStallList = JSON.parse(savedStallList);
            }
            if (savedTimeSlot) {
                this.selectedTimeSlot = savedTimeSlot;
            }
            if (savedTotalCount) {
                this.totalCount = parseInt(savedTotalCount);
            }
            if (savedTotal) {
                this.total = parseFloat(savedTotal);
            }


            // 清除保存的数据
            localStorage.removeItem('selectedStallList');
            localStorage.removeItem('selectedTimeSlot');
            localStorage.removeItem('totalCount');
            localStorage.removeItem('total');
        },
        methods: {
            checkLoginStatus() {
                fetch('{{route('check-login')}}')
                    .then(response => response.json())
                    .then(data => {
                        this.isLoggedIn = data.loggedIn;
                    })
                    .catch(error => {
                        console.error('Error checking login status:', error);
                    });
            },


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
            getData() {
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

                this.isMakePaymentClicked = true;

                if (!this.isLoggedIn) {
                    // 用户未登录，重定向到登录页面并保存选择的数据
                    localStorage.setItem('selectedStallList', JSON.stringify(this.selectedStallList));
                    localStorage.setItem('selectedTimeSlot', this.selectedTimeSlot);
                    localStorage.setItem('totalCount', this.totalCount);
                    localStorage.setItem('total', this.total);
                    window.location.href = "{{ route('login') }}";
                    return;
                }
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
                    })
                    .finally(() => {
                        this.isMakePaymentClicked = false;
                    });

                ;
            }
        },
    }).mount('#app')
</script>


@include('footer');
