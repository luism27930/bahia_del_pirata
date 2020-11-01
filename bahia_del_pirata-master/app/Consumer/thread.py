import threading
import subprocess
class ThreadClass(threading.Thread):

    def run(self):
        subprocess.call(["php", "Consumer.php"])

for i in range(5):
    t = ThreadClass()
    t.start()