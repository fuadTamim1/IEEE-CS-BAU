
import * as THREE from 'three';
import { GLTFLoader } from 'three/examples/jsm/Addons.js';

window.THREE = THREE; // Optional: Make it globally accessible
document.addEventListener('DOMContentLoaded', () => {
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({ alpha: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setClearColor(0x000000, 0); // Transparent
    document.body.appendChild(renderer.domElement);

    const light = new THREE.HemisphereLight(0xffffff, 0x444444, 1);
    scene.add(light);

    const loader = new GLTFLoader();
    let model = null;
    loader.load('/assets/models/logo.glb', (gltf) => {
        model = gltf.scene;
        scene.add(model);
        model.position.set(125, -100, -200);
        animate();
    }, undefined, function (error) {
        console.error('An error occurred while loading the model:', error);
    });

    camera.position.z = 5;

    function animate() {
        requestAnimationFrame(animate);
        model.rotation.x += 0.01;
        model.rotation.y += 0.01;
        renderer.render(scene, camera);
    }
});
