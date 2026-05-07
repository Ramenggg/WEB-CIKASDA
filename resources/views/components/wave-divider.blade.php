<canvas id="heroWaves" class="absolute bottom-0 left-0 w-full h-17.5 z-20 pointer-events-none"></canvas>

<script>
    {
        const c = document.getElementById("heroWaves"),
            ctx = c.getContext("2d");
        let w, t = 0;

        // Set ukuran canvas yang jauh lebih pendek
        window.onresize = () => w = c.width = window.innerWidth;
        w = c.width = window.innerWidth;
        c.height = 70;

        // y = posisi vertikal, a = tinggi gelombang, f = kerapatan, s = kecepatan, c = warna
        // Layer terakhir dibuat putih agar transisi ke section bawah terlihat natural
        const waves = [{
                y: 35,
                a: 12,
                f: 0.005,
                s: 0.020,
                c: "rgba(56,189,248,.4)"
            },
            {
                y: 45,
                a: 15,
                f: 0.004,
                s: 0.025,
                c: "rgba(14,165,233,.7)"
            },
            {
                y: 55,
                a: 10,
                f: 0.006,
                s: 0.035,
                c: "#0284c7"
            }
        ];

        // Loop animasi
        (function draw() {
            ctx.clearRect(0, 0, w, 70);
            t++;
            waves.forEach(v => {
                ctx.beginPath();
                ctx.lineTo(0, 70);
                for (let x = 0; x <= w; x += 3) ctx.lineTo(x, v.y + Math.sin(x * v.f + t * v.s) * v.a);
                ctx.lineTo(w, 70);
                ctx.fillStyle = v.c;
                ctx.fill();
            });
            requestAnimationFrame(draw);
        })();
    }
</script>
