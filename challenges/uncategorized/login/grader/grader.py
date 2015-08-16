def grade(arg, key):
    if "flag{sq!_inj3cti0n}".lower() == key.lower():
        return True, "=)"
    else:
        return False, "..."
