def grade(arg, key):
	if "flag{L0cal_Fil3_Inclusi0n_C@n_B3_Fun}".lower() == key.lower():
		return True, "File inclusion can give you remote command execution too!"
	else:
		return False, "Try harder."
