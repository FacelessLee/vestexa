import React, { useEffect, useRef } from 'react';

interface FallingFlagsCanvasProps {
  scrollProgress?: number;
}

interface FlagBody {
  x: number;
  y: number;
  vx: number;
  vy: number;
  radius: number;
  angle: number;
  angularVelocity: number;
  image: HTMLImageElement;
  isReady: boolean;
}

const CURRENCY_LIST = [
  'USD',
  'EUR',
  'GBP',
  'CAD',
  'AUD',
  'CHF',
  'SGD',
  'PLN',
  'BRL',
  'NOK',
];

export const FallingFlagsCanvas: React.FC<FallingFlagsCanvasProps> = () => {
  const canvasRef = useRef<HTMLCanvasElement | null>(null);
  const animFrameRef = useRef<number | null>(null);
  const bodiesRef = useRef<FlagBody[]>([]);
  const lastScrollYRef = useRef<number>(0);
  const isVisibleRef = useRef<boolean>(false);

  useEffect(() => {
    const canvas = canvasRef.current;
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    let dpr = window.devicePixelRatio || 1;
    let width = canvas.parentElement?.clientWidth || window.innerWidth;
    let height = canvas.parentElement?.clientHeight || window.innerHeight;

    const resize = () => {
      dpr = window.devicePixelRatio || 1;
      width = canvas.parentElement?.clientWidth || window.innerWidth;
      height = canvas.parentElement?.clientHeight || window.innerHeight;
      canvas.width = width * dpr;
      canvas.height = height * dpr;
      canvas.style.width = `${width}px`;
      canvas.style.height = `${height}px`;
    };

    resize();
    window.addEventListener('resize', resize);

    // Load flag images
    const bodies: FlagBody[] = CURRENCY_LIST.map((curr, idx) => {
      const img = new Image();
      const body: FlagBody = {
        x: (width * 0.15) + ((width * 0.7) / CURRENCY_LIST.length) * idx + (Math.random() * 20 - 10),
        y: -40 - idx * 55 - Math.random() * 30,
        vx: (Math.random() - 0.5) * 1.5,
        vy: 1.5 + Math.random() * 2,
        radius: Math.max(18, Math.min(width * 0.055, 25)),
        angle: (Math.random() - 0.5) * 0.5,
        angularVelocity: (Math.random() - 0.5) * 0.04,
        image: img,
        isReady: false,
      };

      img.src = `/currencies/${curr}.svg`;
      img.onload = () => {
        body.isReady = true;
      };

      return body;
    });

    bodiesRef.current = bodies;

    // Scroll impulse handler
    lastScrollYRef.current = window.scrollY;
    const handleScroll = () => {
      const currentScrollY = window.scrollY;
      const delta = currentScrollY - lastScrollYRef.current;
      lastScrollYRef.current = currentScrollY;

      // Apply physics impulse on scroll
      const impulse = Math.min(Math.max(delta * 0.06, -8), 8);
      bodiesRef.current.forEach((b) => {
        b.vy += impulse;
        b.vx += (Math.random() - 0.5) * impulse * 0.3;
        b.angularVelocity += (Math.random() - 0.5) * impulse * 0.02;
      });
    };

    window.addEventListener('scroll', handleScroll, { passive: true });

    // Visibility observer to save battery when offscreen
    const observer = new IntersectionObserver(
      ([entry]) => {
        isVisibleRef.current = entry.isIntersecting;
      },
      { threshold: 0.05 }
    );
    observer.observe(canvas);

    // Physics update loop
    let lastTime = performance.now();
    const gravity = 0.28;
    const bounce = 0.65;
    const airFriction = 0.988;

    const loop = (now: number) => {
      const dt = Math.min((now - lastTime) / 16.66, 2.5);
      lastTime = now;

      if (isVisibleRef.current && ctx) {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        ctx.save();
        ctx.scale(dpr, dpr);

        const currentBodies = bodiesRef.current;
        const floorY = height - 90; // clear mobile floating dock

        for (let i = 0; i < currentBodies.length; i++) {
          const b = currentBodies[i];

          // Apply forces
          b.vy += gravity * dt;
          b.vx *= Math.pow(airFriction, dt);
          b.vy *= Math.pow(airFriction, dt);
          b.angularVelocity *= Math.pow(0.97, dt);

          // Update position
          b.x += b.vx * dt;
          b.y += b.vy * dt;
          b.angle += b.angularVelocity * dt;

          // Floor bounce
          if (b.y + b.radius > floorY) {
            b.y = floorY - b.radius;
            b.vy = -Math.abs(b.vy) * bounce;
            b.vx += (Math.random() - 0.5) * 0.8;
            b.angularVelocity = (Math.random() - 0.5) * 0.05;
          }

          // Left/Right wall bounce
          if (b.x - b.radius < 12) {
            b.x = 12 + b.radius;
            b.vx = Math.abs(b.vx) * bounce;
          } else if (b.x + b.radius > width - 12) {
            b.x = width - 12 - b.radius;
            b.vx = -Math.abs(b.vx) * bounce;
          }

          // Gentle circle-to-circle collision
          for (let j = i + 1; j < currentBodies.length; j++) {
            const b2 = currentBodies[j];
            const dx = b2.x - b.x;
            const dy = b2.y - b.y;
            const dist = Math.sqrt(dx * dx + dy * dy);
            const minDist = b.radius + b2.radius;

            if (dist > 0 && dist < minDist) {
              const overlap = 0.5 * (minDist - dist);
              const nx = dx / dist;
              const ny = dy / dist;

              b.x -= nx * overlap;
              b.y -= ny * overlap;
              b2.x += nx * overlap;
              b2.y += ny * overlap;

              const kx = b.vx - b2.vx;
              const ky = b.vy - b2.vy;
              const p = 2 * (nx * kx + ny * ky) / 2;

              b.vx -= p * nx * 0.6;
              b.vy -= p * ny * 0.6;
              b2.vx += p * nx * 0.6;
              b2.vy += p * ny * 0.6;
            }
          }

          // Draw the round flag badge
          if (b.isReady && b.y + b.radius > 0 && b.y - b.radius < height) {
            ctx.save();
            ctx.translate(b.x, b.y);
            ctx.rotate(b.angle);

            // Subtle drop shadow
            ctx.shadowColor = 'rgba(0, 0, 0, 0.16)';
            ctx.shadowBlur = 10;
            ctx.shadowOffsetY = 4;

            // Clip circle
            ctx.beginPath();
            ctx.arc(0, 0, b.radius, 0, Math.PI * 2);
            ctx.fillStyle = '#FFFFFF';
            ctx.fill();
            ctx.clip();

            // Draw flag image
            ctx.drawImage(b.image, -b.radius, -b.radius, b.radius * 2, b.radius * 2);

            // Circular rim border
            ctx.beginPath();
            ctx.arc(0, 0, b.radius - 0.5, 0, Math.PI * 2);
            ctx.strokeStyle = 'rgba(255, 255, 255, 0.85)';
            ctx.lineWidth = 1.5;
            ctx.stroke();

            ctx.restore();
          }
        }

        ctx.restore();
      }

      animFrameRef.current = requestAnimationFrame(loop);
    };

    animFrameRef.current = requestAnimationFrame(loop);

    return () => {
      window.removeEventListener('resize', resize);
      window.removeEventListener('scroll', handleScroll);
      observer.disconnect();
      if (animFrameRef.current) {
        cancelAnimationFrame(animFrameRef.current);
      }
    };
  }, []);

  return (
    <canvas
      ref={canvasRef}
      className="absolute inset-0 pointer-events-none z-20 block lg:hidden"
      aria-hidden="true"
    />
  );
};

