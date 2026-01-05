import React, { useEffect, useState } from "react";
import { MapContainer, TileLayer, Marker, Popup } from "react-leaflet";
import "leaflet/dist/leaflet.css";
import { db, ref, onValue } from "./firebase";

const MapWithLiveLocations = () => {
    const [locations, setLocations] = useState({});

    useEffect(() => {
        // Volg live locaties vanuit Firebase
        const locationRef = ref(db, "locations");
        onValue(locationRef, (snapshot) => {
            setLocations(snapshot.val() || {});
        });
    }, []);

    return (
        <MapContainer center={[51.505, -0.09]} zoom={13} style={{ height: "100vh", width: "100%" }}>
            <TileLayer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" />

            {Object.entries(locations).map(([id, loc]) => (
                <Marker key={id} position={[loc.latitude, loc.longitude]}>
                    <Popup>
                        <div>Friend ID: {id}</div>
                        <div>Lat: {loc.latitude}</div>
                        <div>Lng: {loc.longitude}</div>
                    </Popup>
                </Marker>
            ))}
        </MapContainer>
    );
};

export default MapWithLiveLocations;
