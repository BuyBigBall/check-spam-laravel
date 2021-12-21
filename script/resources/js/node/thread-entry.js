// thread-entry.js
const {parentPort} = require("worker_threads");

console.log("Hello world");

parentPort.postMessage("Hello from the other side")

parentPort.close();







// // public/workers/example.worker.js
// // 1. Import a script, in this case the JavaScript Obfuscator library
// self.importScripts("https://cdn.jsdelivr.net/npm/javascript-obfuscator@latest/dist/index.browser.min.js");

// // 2. Listen to every message posted from the Worker initializator
// self.addEventListener('message', function(MessageEvent) {
//     switch(MessageEvent.data.eventName){

//         // 3. React to the `obfuscate` event
//         case "obfuscate":
//             // 4. arguments will contain the object that you pass as second argument to the WorkerHelper.trigger method
//             let arguments = MessageEvent.data.data;

//             // 5. Run the logic that takes a lot of time to execute, in this case, the JavaScript obfuscation
//             let obfuscationResult = JavaScriptObfuscator.obfuscate(arguments.code);

//             // 6. Send the obfuscated code to the main thread with the identifier of this event (obfuscate)
//             self.postMessage({
//                 "event": MessageEvent.data.eventName,
//                 "data": {
//                     "code": obfuscationResult.getObfuscatedCode()
//                 }
//             });
//         break;
//     }
// }, false);