//index.js
const { Worker } = require("worker_threads");
const THREADS_AMOUNT = 4;
(function () {
  // Array of promises
  //const { Worker } = require("worker_threads");
  const promises = [];
  for (let idx = 0; idx < THREADS_AMOUNT; idx += 1) {
    // Add promise in the array of promises
    promises.push(new Promise((resolve) => {
      const worker = new Worker("./resources/js/node/thread-entry.js", 
      {
        workerData: {
          workerId: idx
        }
      });
      worker.on("exit", () => {
        console.log("Closing ", idx);
        resolve()
      });
      worker.on("message", (value) => {
        console.log(`message received from ${idx}: ${value}`);
      })
    }))
  }
  // Handle the resolution of all promises
  return Promise.all(promises);
})().then(() => {
  canRun = false;
})
// infinite loop





// // 1. Import the created file
// import WorkerHelper from './WorkerHelper';

// // 2. Create the worker helper instance
// let worker = new WorkerHelper("./thread-entry.js"); 

// // 3. Run the code that responds to the `obfuscate` event name in the worker
// // passing an object as argument
// worker.trigger("obfuscate", {
//     "code": `
//         let name = 'Carlos';
//     `
// });

// // 4. Attach the listener that reacts to the obfuscate event triggered by the worker
// worker.on("obfuscate", function(data){
//     // Will display an object with the response of the worker:
//     // e.g. {code: "const _0x3773=['3617462yGjhHE','537744gbuLjY','964…;}}}(_0x3773,0xb9d46));let name=_0x3ee9be(0x1ab);"}
//     console.log(data);
// });

// // 5. Listen in case of errors
// worker.on("error", function(err){
//     console.log(err);
// });



