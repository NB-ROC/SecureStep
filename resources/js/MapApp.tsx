import React, { useEffect, useState } from 'react';
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
import 'leaflet-routing-machine/dist/leaflet-routing-machine.css';
import 'leaflet-routing-machine';

interface Friend {
    id: number;
    name: string;
    lat: number;
    lng: number;
}

export default function MapApp() {
    const [map, setMap] = useState<L.Map | null>(null);

    // Vrienden rond Nijmegen
    const [friends] = useState<Friend[]>([
        { id: 1, name: 'Alice', lat: 51.845, lng: 5.852 },
        { id: 2, name: 'Bob', lat: 51.840, lng: 5.860 },
        { id: 3, name: 'Charlie', lat: 51.850, lng: 5.855 },
        { id: 4, name: 'Diana', lat: 51.838, lng: 5.848 },
    ]);

    // Haversine formule voor echte afstand
    const getDistance = (lat1: number, lng1: number, lat2: number, lng2: number) => {
        const R = 6371e3; // radius aarde in meters
        const φ1 = (lat1 * Math.PI) / 180;
        const φ2 = (lat2 * Math.PI) / 180;
        const Δφ = ((lat2 - lat1) * Math.PI) / 180;
        const Δλ = ((lng2 - lng1) * Math.PI) / 180;

        const a = Math.sin(Δφ/2) * Math.sin(Δφ/2) +
            Math.cos(φ1) * Math.cos(φ2) *
            Math.sin(Δλ/2) * Math.sin(Δλ/2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));

        return R * c; // afstand in meters
    };

    useEffect(() => {
        if (!map) {
            const newMap = L.map('map').setView([51.8425, 5.8528], 13); // Nijmegen centrum
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(newMap);
            setMap(newMap);
        }

        if (!map) return;

        // Voeg markers toe voor vrienden
        friends.forEach(f => {
            L.marker([f.lat, f.lng])
                .addTo(map)
                .bindPopup(f.name);
        });

        // Eigen locatie ophalen
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(pos => {
                const { latitude, longitude } = pos.coords;
                map.setView([latitude, longitude], 13);

                L.marker([latitude, longitude])
                    .addTo(map)
                    .bindPopup('Jouw locatie')
                    .openPopup();

                // Vind dichtstbijzijnde vriend
                let closestFriend: Friend | null = null;
                let minDistance = Infinity;

                friends.forEach(f => {
                    const distance = getDistance(latitude, longitude, f.lat, f.lng);
                    if (distance < minDistance) {
                        minDistance = distance;
                        closestFriend = f;
                    }
                });

                if (closestFriend) {
                    // Looproute tonen naar dichtstbijzijnde vriend
                    // @ts-ignore
                    L.Routing.control({
                        waypoints: [
                            L.latLng(latitude, longitude),
                            L.latLng(closestFriend.lat, closestFriend.lng),
                        ],
                        lineOptions: {
                            styles: [{ color: 'blue', opacity: 0.6, weight: 5 }]
                        },
                        routeWhileDragging: false,
                        show: true,
                        addWaypoints: false,
                        router: L.Routing.osrmv1({
                            serviceUrl: 'https://router.project-osrm.org/route/v1',
                            profile: 'foot', // looproute
                        }),
                    }).addTo(map);
                }
            });
        }

    }, [map, friends]);

    return (
        <div className="w-full h-screen">
            <div id="map" className="w-full h-full"></div>
        </div>
    );
}


