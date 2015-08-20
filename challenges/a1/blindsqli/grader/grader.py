def grade(arg, key):
	if "flag{blind_sql_injection_attack}".lower() == key.lower():
		return True, "Blind doesn't mean impossible."
	else:
		return False, "Try something simple like 1=1 first.."
