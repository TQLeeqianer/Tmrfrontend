@include('header');


<section class="home" id="app">
    <div class="content event-container">
        <h1>Server-Sent Events Demo</h1>
        <p>Current Server Time: @{{ serverTime }}</p>
    </div>
</section>

<script>
    const { createApp } = Vue

    createApp({
        data() {
            return {
                message: 'Hello Vue!',
                serverTime: '',
            }
        },
        mounted() {
            console.log(`the component is now mounted.`);
            this.startSSE();
        },
        methods: {
            startSSE() {
                const eventSource = new EventSource('/stream');

                eventSource.onmessage = (event) => {
                    const data = JSON.parse(event.data);
                    this.serverTime = data.time;
                };

                eventSource.onerror = () => {
                    console.error("Failed to connect to SSE");
                    eventSource.close();
                };
            },
        },
    }).mount('#app')
</script>



@include('footer');
