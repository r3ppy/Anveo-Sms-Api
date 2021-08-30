import requests, json
from requests.packages.urllib3.exceptions import InsecureRequestWarning
requests.packages.urllib3.disable_warnings(InsecureRequestWarning)

XINO = open(raw_input("Phone Numbers ? "), "r").read().split("\n")

API = "a3e6815558170a640bb6eaafa1885f4450dda419"
FROM = "14702062783"
MSG = "Hello World!"

for NUBMER in XINO:
	r = requests.get("https://bagozasndr.com/sms.php?key={}&from={}&to={}&msg={}".format(API, FROM, NUBMER, MSG)).content
	r = eval(r)
	if str(r['Status']) == "1":
		New_Message_Count = r['RemainingMessages']
		print '[ + ] Sent : '+ NUBMER +", Remaining Messages : "+str(New_Message_Count)
	else:
		# New_Message_Count = r['RemainingMessages']
		print '[ - ] Failed : '+ NUBMER